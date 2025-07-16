<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
public function index()
{
    // Получаем статьи текущего пользователя, самые свежие первыми
    $articles = Auth::user()
        ->articles()
        ->orderBy('created_at', 'desc')
        ->get();

    return view('articles.index', compact('articles'));
}

    public function create()
    {
        return view('articles.create');
    }

    public function generate(Request $request)
    {
        set_time_limit(0);
        $request->validate([
            'topic' => 'required|string|max:255',
            'type' => 'required|in:эссе,сочинение,доклад',
        ]);

        $topic = $request->input('topic');
        $type = $request->input('type');
        $withSearch = $request->has('with_search') ? '1' : '0';

        // Подготовка команды
        $max = Auth::user()->getMaxLength();
        $length = min($request->input('length', 1000), $max);
        $escapedTopic = escapeshellarg($topic);
        $escapedType = escapeshellarg($type);
        $escapedFlag = escapeshellarg($withSearch);
        $escapedLen = escapeshellarg($length);
      

        // передаём в Python
        
        $cmd = "py " . base_path('scripts/ai_integration.py') . " $escapedTopic $escapedType $escapedFlag $escapedLen";
        $output = shell_exec($cmd);

        if (!$output) {
            return back()->with('error', "Ошибка генерации текста: $cmd");
        }

        // Сохраняем статью
        $article = Article::create([
            'user_id' => Auth::id(),
            'topic' => $topic,
            'type' => $type,
            'content' => $output,
        ]);

        return redirect()->route('articles.show', $article);
    }

    public function show(Article $article)
    {
        #$this->authorize('view', $article); // если хочешь ограничить доступ
        return view('articles.show', compact('article'));
    }

    public function togglePublish(Article $article): RedirectResponse
    {
        $this->authorize('update', $article);

        $article->is_published = ! $article->is_published;
        $article->save();

        $msg = $article->is_published
            ? 'Статья опубликована'
            : 'Статья снята с публикации';

        return back()->with('success', $msg);
    }

    /**
     * Публичный каталог: все опубликованные
     */
    public function catalog(Request $request)
{
    $query = Article::where('is_published', true);

    if ($q = $request->input('q')) {
        $query->where(function ($sub) use ($q) {
            $sub->where('topic', 'like', "%{$q}%")
                ->orWhere('type', 'like', "%{$q}%");
        });
    }

    if ($type = $request->input('type')) {
        $query->where('type', $type);
    }

    $sort = $request->input('sort', 'desc');
    $query->orderBy('created_at', $sort);

    $articles = $query->paginate(10)->appends($request->all());

    return view('articles.catalog', compact('articles'));
}
}
