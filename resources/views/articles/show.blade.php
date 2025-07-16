<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->topic }}
        </h2>
    </x-slot>

    <arlicle class="py-6 max-w-3xl mx-auto">
        <div class="mb-2 text-sm text-gray-500">Тип: {{ $article->type }}</div>
        <pre class="bg-gray-100 p-4 rounded whitespace-pre-wrap">{{ $article->content }}</pre>
</article>
</x-app-layout>