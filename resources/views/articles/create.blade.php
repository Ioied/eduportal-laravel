<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Генерация статьи
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('articles.generate') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Тема</label>
                <input type="text" name="topic" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Тип материала</label>
                <select name="type" class="w-full border rounded p-2" required>
                    <option value="эссе">Эссе</option>
                    <option value="сочинение">Сочинение</option>
                    <option value="доклад">Доклад</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Длина статьи (символов)</label>
                <input 
                    type="number" 
                    name="length" 
                    value="{{ old('length', auth()->user()->getMaxLength()) }}"
                    min="100" 
                    max="{{ auth()->user()->getMaxLength() }}"
                    class="w-full border rounded p-2"
                />
                <p class="text-xs text-gray-500">
                    Максимум {{ auth()->user()->getMaxLength() }} символов
                </p>
            </div>

            <div class="mb-4">
                <label><input type="checkbox" name="with_search"> Добавить информацию из интернета</label>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Сгенерировать</button>
        </form>


       

    </div>
</x-app-layout>