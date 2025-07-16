<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои статьи
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @forelse($articles as $article)
            <a href="{{ route('articles.show', $article) }}"
               class="block bg-white rounded-lg border border-gray-200 p-4 hover:border-gray-300 transition-all">
                <!-- содержимое карточки -->
            </a>

            <div class="bg-white rounded shadow p-4 flex flex-col justify-between">
                <div>
                    <a href="{{ route('articles.show', $article) }}"
                       class="text-blue-600 font-semibold block truncate">
                        {{ $article->topic }}
                    </a>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $article->type }} • {{ $article->created_at->format('d.m.Y') }}
                    </p>
                    <p class="mt-2 text-sm text-gray-700 line-clamp-3">
                        {{ Str::limit($article->content, 100) }}
                    </p>
                </div>
                <form method="POST" action="{{ route('articles.publish', $article) }}" class="mt-4 self-end">
                    @csrf
                    <button class="text-sm px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">
                        {{ $article->is_published ? 'Снять' : 'Опубликовать' }}
                    </button>
                </form>
            </div>

            <div class="py-6 max-w-3xl mx-auto space-y-4">
                <div class="p-4 bg-white rounded shadow flex justify-between items-start">
                    <div>
                        <a href="{{ route('articles.show', $article) }}"
                           class="text-blue-600 font-semibold">
                            {{ $article->topic }}
                        </a>
                        <div class="text-sm text-gray-500">
                            {{ $article->type }} • {{ $article->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>

                    <form method="POST" action="{{ route('articles.publish', $article) }}">
                        @csrf
                        <button type="submit"
                                class="px-3 py-1 text-sm rounded {{ $article->is_published 
                                    ? 'bg-red-200 text-red-800' 
                                    : 'bg-green-200 text-green-800' }}">
                            {{ $article->is_published ? 'Снять с публикации' : 'Опубликовать' }}
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-600">
                У вас пока нет статей.
            </p>
        @endforelse
    </div>
</x-app-layout>
