<x-app-layout>
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-lg p-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('data.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" id="name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                    <textarea id="description" name="description" required rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('press_release') }}" class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Back
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

