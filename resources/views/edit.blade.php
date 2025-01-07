<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4 mb-10">
            <div class="container mx-auto mt-4 p-5 bg-white shadow-lg rounded-lg">
        <h2 class="text-lg font-semibold">Edit Press Release</h2>
    
        @if (session()->has('message'))
            <div class="mb-4 text-green-500">
                {{ session('message') }}
            </div>
        @endif
    
        <form method="POST" action="{{ route('data.update', $pressRelease->id) }}" id="createForm">
            @csrf
            @method('PUT') <!-- Untuk spoofing metode HTTP -->

            <div class="mb-4 mt-4">
                <label for="date" class="block text-sm font-medium">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date', $pressRelease->date) }}" class="w-full p-2 border rounded-md @error('press_name') border-red-500 @enderror" placeholder="Pilih tanggal" required>@error('press_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        
            <div class="mb-4">
                <label for="press_name" class="block text-sm font-medium">Press Name</label>
                <input type="text" id="press_name" name="press_name" class="w-full p-2 border rounded-md @error('press_name') border-red-500 @enderror" value="{{($pressRelease->press_name)}}">
                @error('press_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
    
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <!-- QuillJS editor -->
                <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    {!! $pressRelease->description !!}
                </div>
                <input type="hidden" id="description" name="description">
            </div>
    
            <div class="mb-4">
                <label for="link_kabarnusa" class="block text-sm font-medium">Link_kabarnusa</label>
                <input type="url" id="link_kabarnusa" name="link_kabarnusa" class="w-full p-2 border rounded-md @error('link_kabarnusa') border-red-500 @enderror" value="{{($pressRelease->link_kabarnusa)}}">
                @error('link_kabarnusa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_baliportal" class="block text-sm font-medium">Link_baliportal</label>
                <input type="url" id="link_baliportal" name="link_baliportal" class="w-full p-2 border rounded-md @error('link_baliportal') border-red-500 @enderror" value="{{($pressRelease->link_baliportal)}}">
                @error('link_baliportal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_updatebali" class="block text-sm font-medium">Link_updatebali</label>
                <input type="url" id="link_updatebali" name="link_updatebali" class="w-full p-2 border rounded-md @error('link_updatebali') border-red-500 @enderror" value="{{($pressRelease->link_updatebali)}}">
                @error('link_updatebali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_pancarpos" class="block text-sm font-medium">Link_pancarpos</label>
                <input type="url" id="link_pancarpos" name="link_pancarpos" class="w-full p-2 border rounded-md @error('link_pancarpos') border-red-500 @enderror" value="{{($pressRelease->link_pancarpos)}}">
                @error('link_pancarpos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_wartadewata" class="block text-sm font-medium">Link_wartadewata</label>
                <input type="url" id="link_wartadewata" name="link_wartadewata" class="w-full p-2 border rounded-md @error('link_wartadewata') border-red-500 @enderror " value="{{($pressRelease->link_wartadewata)}}">
                @error('link_wartadewata') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_baliexpress" class="block text-sm font-medium">Link_baliexpress</label>
                <input type="url" id="link_baliexpress" name="link_baliexpress" class="w-full p-2 border rounded-md @error('link_baliexpress') border-red-500 @enderror" value="{{($pressRelease->link_baliexpress)}}">
                @error('link_baliexpress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_fajarbali" class="block text-sm font-medium">Link_fajarbali</label>
                <input type="url" id="link_fajarbali" name="link_fajarbali" class="w-full p-2 border rounded-md @error('link_fajarbali') border-red-500 @enderror" value="{{($pressRelease->link_fajarbali)}}">
                @error('link_fajarbali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_balitribune" class="block text-sm font-medium">Link_balitribune</label>
                <input type="url" id="link_balitribune" name="link_balitribune" class="w-full p-2 border rounded-md @error('link_balitribune') border-red-500 @enderror" value="{{($pressRelease->link_balitribune)}}">
                @error('link_balitribune') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_radarbali" class="block text-sm font-medium">Link_radarbali</label>
                <input type="url" id="link_radarbali" name="link_radarbali" class="w-full p-2 border rounded-md @error('link_radarbali') border-red-500 @enderror" value="{{($pressRelease->link_radarbali)}}">
                @error('link_radarbali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_dutabali" class="block text-sm font-medium">Link_dutabali</label>
                <input type="url" id="link_dutabali" name="link_dutabali" class="w-full p-2 border rounded-md @error('link_dutabali') border-red-500 @enderror" value="{{($pressRelease->link_dutabali)}}">
                @error('link_dutabali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_baliekbis" class="block text-sm font-medium">Link_baliekbis</label>
                <input type="url" id="link_baliekbis" name="link_baliekbis" class="w-full p-2 border rounded-md @error('link_baliekbis') border-red-500 @enderror" value="{{($pressRelease->link_baliekbis)}}">
                @error('link_baliekbis') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_baliprawara" class="block text-sm font-medium">Link_Baliprawara</label>
                <input type="url" id="link_baliprawara" name="link_baliprawara" class="w-full p-2 border rounded-md @error('link_baliprawara') border-red-500 @enderror" value="{{($pressRelease->link_baliprawara)}}">
                @error('link_baliprawara') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_baliwara" class="block text-sm font-medium">Link_baliwara</label>
                <input type="url" id="link_baliwara" name="link_baliwara" class="w-full p-2 border rounded-md @error('link_baliwara') border-red-500 @enderror" value="{{($pressRelease->link_baliwara)}}">
                @error('link_baliwara') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_balipost" class="block text-sm font-medium">Link_balipost</label>
                <input type="url" id="link_balipost" name="link_balipost" class="w-full p-2 border rounded-md @error('link_balipost') border-red-500 @enderror" value="{{($pressRelease->link_balipost)}}">
                @error('link_balipost') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="link_other" class="block text-sm font-medium">Link_other</label>
                <input type="text" id="link_other" name="link_other" class="w-full p-2 border rounded-md @error('link_other') border-red-500 @enderror" value="{{($pressRelease->link_other)}}">
                @error('link_other') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
    
            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Save Changes</button>
                <a href="{{ route('press_release') }}" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
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
                    ['link', 'image'],
                ],
            },
        });
    
        // Ensure Quill content is copied into the hidden textarea before submit
        const form = document.getElementById('createForm'); // Form ID harus benar
        form.addEventListener('submit', function (event) {
            const descriptionInput = document.getElementById('description');
            const editorContent = quill.root.innerHTML.trim(); // Mengambil konten dari Quill
    
            // Jika konten kosong, tampilkan peringatan dan batalkan pengiriman form
            if (editorContent === '<p><br></p>' || editorContent === '') {
                alert('Description cannot be empty.');
                event.preventDefault(); // Mencegah form submit
            } else {
                descriptionInput.value = editorContent; // Menyimpan konten ke dalam input tersembunyi
            }
        });
    </script>
    
</body>
</html>    
    
    
</x-app-layout>
