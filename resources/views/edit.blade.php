<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    
        <form method="POST" action="{{ route('data.update', $pressRelease->id) }}">
            @csrf
            @method('PUT') <!-- Untuk spoofing metode HTTP -->
        
            <div class="mb-4">
                <label for="press_name" class="block text-sm font-medium">Press Name</label>
                <input type="text" id="press_name" name="press_name" class="w-full p-2 border rounded-md @error('press_name') border-red-500 @enderror" value="{{($pressRelease->press_name)}}">
                @error('press_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
    
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <textarea id="description" name="description" rows="5" class="w-full p-2 border rounded-md @error('description') border-red-500 @enderror" >{{($pressRelease->description)}}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
    
</body>
</html>    
    
    
</x-app-layout>
