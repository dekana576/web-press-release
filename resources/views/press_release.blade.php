<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Press Release') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto p-8">
                    <div class="flex justify-left">
                            <a href="{{ route('data.create') }}" class="block text-center">
                                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Add Data</button>
                            </a>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>