<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Create Press</title>
        <!-- QuillJS Styles -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    </head>
    <body>
        <div class="flex justify-center mt-8">
            <div class="w-full max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-8">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->has('image.*'))
                        <div class="mt-2 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ $errors->first('image.*') }}
                        </div>
                        @endif
                <form action="{{ route('data.store') }}" method="POST" class="space-y-4" id="createForm" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <!-- QuillJS Editor -->
                        <div id="editor" class="h-40 border rounded-md"></div>
                        <!-- Hidden Input to store the HTML content -->
                        <textarea id="description" name="description" style="display: none;"></textarea>
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Upload Images:</label>
                        <input type="file" id="image" name="image[]" accept="image/*" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        
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

        <!-- QuillJS Scripts -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            // Initialize QuillJS
            const quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Write something amazing...',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link', 'image'], // Include image button in toolbar
                    ],
                },
            });

            // Ensure Quill content is copied into the hidden textarea
            const form = document.getElementById('createForm');
            form.addEventListener('submit', function (event) {
                const descriptionInput = document.getElementById('description');
                const editorContent = quill.root.innerHTML.trim();

                // Check if content is empty
                if (editorContent === '<p><br></p>' || editorContent === '') {
                    alert('Description cannot be empty.');
                    event.preventDefault(); // Prevent form submission
                } else {
                    descriptionInput.value = editorContent; // Set value in textarea
                }
            });
        </script>
    </body>
    </html>
</x-app-layout>
