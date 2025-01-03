<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-8 p-6 mb-10">
                <!-- Back Button and Date -->
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('press_release') }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition-all">
                        &lt; Back
                    </a>
                    <p class="text-gray-500 text-sm">Tanggal: {{ \Carbon\Carbon::parse($press->created_at)->format('d-m-Y') }}</p>
                </div>

                <!-- Judul -->
                <h1 class="text-4xl font-bold text-center mb-5">{{ $press->press_name }}</h1>

                
                <!-- Deskripsi -->
                <div class="text-lg leading-relaxed text-gray-700 mb-8 px-4 lg:px-20">
                    {!! $press->description !!}
                </div>
                <!-- Bagian Link -->
                <h1 class="text-center font-bold text-xl bg-red-100 p-3 rounded-md mb-6">LINK</h1>

                <!-- Responsive Grid for Links -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @php
                        function renderLinkButton($name, $link) {
                            if ($link) {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2'>{$name}</div>
                                            <button class='w-full px-4 py-2 rounded-md text-white bg-blue-400 hover:bg-blue-500 transition'>
                                                <a href='{$link}' target='_blank'>Visit</a>
                                            </button>
                                        </div>";
                            } else {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2'>{$name}</div>
                                            <button class='w-full px-4 py-2 rounded-md text-white bg-red-400 cursor-not-allowed'>
                                                Kosong
                                            </button>
                                        </div>";
                            }
                        }
                    @endphp

                    {!! renderLinkButton('Kabar Nusa', $press->link_kabarnusa) !!}
                    {!! renderLinkButton('Bali Portal', $press->link_baliportal) !!}
                    {!! renderLinkButton('Update Bali', $press->link_updatebali) !!}
                    {!! renderLinkButton('Pancar Pos', $press->link_pancarpos) !!}
                    {!! renderLinkButton('Warta Dewata', $press->link_wartadewata) !!}
                    {!! renderLinkButton('Bali Express', $press->link_baliexpress) !!}
                    {!! renderLinkButton('Fajar Bali', $press->link_fajarbali) !!}
                    {!! renderLinkButton('Bali Tribune', $press->link_balitribune) !!}
                    {!! renderLinkButton('Radar Bali', $press->link_radarbali) !!}
                    {!! renderLinkButton('Duta Bali', $press->link_dutabali) !!}
                    {!! renderLinkButton('Baliekbis', $press->link_baliekbis) !!}

                    <!-- Other Links -->
                    <div class="text-center">
                        <div class="text-gray-700 font-bold mb-2">Other</div>
                        <button 
                            id="otherButton" 
                            class="w-full px-4 py-2 rounded-md text-white bg-green-400 hover:bg-green-500 transition"
                            onclick="toggleTextarea('otherButton', 'otherTextarea', '{{ $press->link_other }}')">
                            Open
                        </button>
                    </div>
                </div>

                <!-- Textarea for Other Links -->
                <textarea 
                    id="otherTextarea" 
                    class="mt-6 w-full p-3 rounded-md border border-gray-300 shadow-sm" 
                    style="display: none;" 
                    readonly
                    rows="10">
                </textarea>
            </div>
        </div>
    </body>
    <script>
        function toggleTextarea(buttonId, textareaId, data) {
            const button = document.getElementById(buttonId);
            const textarea = document.getElementById(textareaId);

            if (textarea.style.display === 'none') {
                textarea.style.display = 'block';
                textarea.value = data;
                button.textContent = 'Close';
                button.classList.remove('bg-green-400', 'hover:bg-green-500');
                button.classList.add('bg-red-400', 'hover:bg-red-500');
            } else {
                textarea.style.display = 'none';
                button.textContent = 'Open';
                button.classList.remove('bg-red-400', 'hover:bg-red-500');
                button.classList.add('bg-green-400', 'hover:bg-green-500');
            }
        }
    </script>
    </html>
</x-app-layout>
