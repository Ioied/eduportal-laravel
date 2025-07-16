
@php 
 use Illuminate\Support\Str; 
@endphp

<x-app-layout>
 <!-- Единственный header-slot -->
 <x-slot name="header">
     <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Каталог статей
         </h2>
         <form method="GET" action="{{ route('articles.catalog') }}" class="flex flex-wrap gap-2">
             <input
                 type="text"
                 name="q"
                 value="{{ request('q') }}"
                 placeholder="Поиск по теме…"
                 class="border rounded px-3 py-1 focus:outline-none"
             />
             <select name="type" class="border rounded px-3 py-1">
                 <option value="">Все типы</option>
                 <option value="эссе"     {{ request('type')=='эссе' ? 'selected':'' }}>Эссе</option>
                 <option value="сочинение"{{ request('type')=='сочинение'?'selected':'' }}>Сочинение</option>
                 <option value="доклад"   {{ request('type')=='доклад'   ?'selected':'' }}>Доклад</option>
             </select>
             <select name="sort" class="border rounded px-3 py-1">
                 <option value="desc" {{ request('sort')=='desc' ? 'selected':'' }}>Сначала новые</option>
                 <option value="asc"  {{ request('sort')=='asc'  ? 'selected':'' }}>Сначала старые</option>
             </select>
             <button
                 type="submit"
                 class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700"
             >Применить</button>
         </form>
     </div>
 </x-slot>

 <!-- Основной контент каталога -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 py-6">
     @forelse($articles as $article)
         <a href="{{ route('articles.show', $article) }}"
            class="block bg-white rounded-lg border border-gray-200 p-4 hover:border-gray-300 transition-all">>
             <h3 class="font-semibold text-lg text-blue-600 truncate">
                 {{ $article->topic }}
             </h3>
             <p class="text-sm text-gray-500 mt-1">
                 Автор: {{ $article->user->name }} • {{ $article->created_at->format('d.m.Y H:i') }}
             </p>
             <p class="mt-2 text-gray-700 line-clamp-4">
                 {{ Str::limit($article->content, 120) }}
             </p>
         </a>
     @empty
         <p class="col-span-full text-center text-gray-600">
             Ничего не найдено.
         </p>
     @endforelse
 </div>

 <!-- Пагинация -->
 <div class="mt-6">
     {{ $articles->appends(request()->all())->links() }}
 </div>
</x-app-layout>