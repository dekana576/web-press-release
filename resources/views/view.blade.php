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
                <div class="flex justify-between">

                    <a href="{{ route('press_release') }}" 
                               class="bg-blue-500 text-white px-5 py-1 rounded-lg font-semibold hover:bg-red-600 transition-all">
                                < Back
                    </a>
                    <!-- Tanggal -->
                    <p class="text-gray-500 text-sm mb-4">Tanggal: {{ \Carbon\Carbon::parse($press->created_at)->format('d-m-Y') }}</p>
                </div>

                <!-- Judul -->
                <h1 class="text-4xl font-bold text-center mb-5 mt-10">{{ $press->press_name }}</h1>

                <!-- Deskripsi -->
                <p class="text-lg leading-relaxed text-gray-700 mb-8 m-20">{{ $press->description }}</p>

                <!-- Bagian Link -->
                <h1 class="text-center font-bold text-xl bg-red-100 p-3 rounded-md mb-6">LINK</h1>
                <div class="flex justify-around">
                    <!-- Tombol Link -->
                    @php
                        function renderLinkButton($name, $link) {
                            if ($link) {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-blue-400 hover:bg-blue-500 transition'>
                                                <a href='{$link}' target='_blank' value='$link'>Visit</a>
                                            </button>
                                        </div>";
                            } else {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-red-400 cursor-not-allowed'>
                                                Kosong
                                            </button>
                                        </div>";
                            }
                        }
                    @endphp

                    {!! renderLinkButton('Kabar Nusa', $press->link_kabarnusa) !!}
                    {!! renderLinkButton('Bali Portal', $press->link_baliportal) !!}
                    {!! renderLinkButton('Update Bali', $press->link_updatebali) !!}

                </div>
                <div class="flex justify-around">
                    <!-- Tombol Link -->
                    @php
                        function renderLinkButton2($name, $link) {
                            if ($link) {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-blue-400 hover:bg-blue-500 transition'>
                                                <a href='{$link}' target='_blank' value='$link'>Visit</a>
                                            </button>
                                        </div>";
                            } else {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-red-400 cursor-not-allowed'>
                                                Kosong
                                            </button>
                                        </div>";
                            }
                        }
                    @endphp
                        {!! renderLinkButton2('Pancar Pos', $press->link_pancarpos) !!}
                        {!! renderLinkButton2('Warta Dewata', $press->link_wartadewata) !!}
                        {!! renderLinkButton2('Bali Express', $press->link_baliexpress) !!}

                </div>
                <div class="flex justify-around">
                    <!-- Tombol Link -->
                    @php
                        function renderLinkButton3($name, $link) {
                            if ($link) {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-blue-400 hover:bg-blue-500 transition'>
                                                <a href='{$link}' target='_blank' value='$link'>Visit</a>
                                            </button>
                                        </div>";
                            } else {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-red-400 cursor-not-allowed'>
                                                Kosong
                                            </button>
                                        </div>";
                            }
                        }
                    @endphp
                    {!! renderLinkButton3('Fajar Bali', $press->link_fajarbali) !!}
                    {!! renderLinkButton3('Bali Tribune', $press->link_balitribune) !!}
                    {!! renderLinkButton3('Radar Bali', $press->link_radarbali) !!}

                </div>
                <div class="flex justify-around mb-10">
                    <!-- Tombol Link -->
                    @php
                        function renderLinkButton4($name, $link) {
                            if ($link) {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-blue-400 hover:bg-blue-500 transition'>
                                                <a href='{$link}' target='_blank' value='$link'>Visit</a>
                                            </button>
                                        </div>";
                            } else {
                                return "<div class='text-center'>
                                            <div class='text-gray-700 font-bold mb-2 mt-6'>{$name}</div>
                                            <button class='px-4 py-2 rounded-md text-white bg-red-400 cursor-not-allowed'>
                                                Kosong
                                            </button>
                                        </div>";
                            }
                        }
                    @endphp
                    {!! renderLinkButton4('Duta Bali', $press->link_dutabali) !!}
                    {!! renderLinkButton4('Baliekbis', $press->link_balitribune) !!}

                    <div class='text-center'>
                        <div class='text-gray-700 font-bold mb-2 mt-6'>Other</div>
                        <button 
                        id="otherButton" 
                        class='px-4 py-2 rounded-md text-white bg-green-400 hover:bg-green-500 transition'
                        onclick="toggleTextarea('otherButton', 'otherTextarea', '{{ $press->link_other }}')">
                        Open
                    </button>
                    </div>

                </div>

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
        // Fungsi untuk toggle textarea dan teks tombol
        function toggleTextarea(buttonId, textareaId, data) {
            const button = document.getElementById(buttonId);
            const textarea = document.getElementById(textareaId);

            if (textarea.style.display === 'none') {
                textarea.style.display = 'block'; // Tampilkan textarea
                textarea.value = data; // Set data ke textarea
                button.textContent = 'Close'; // Ubah teks tombol ke 'Close'
                button.classList.remove('bg-green-400', 'hover:bg-green-500');
                button.classList.add('bg-red-400', 'hover:bg-red-500');
            } else {
                textarea.style.display = 'none'; // Sembunyikan textarea
                button.textContent = 'Open'; // Ubah teks tombol ke 'Open'
                button.classList.remove('bg-red-400', 'hover:bg-red-500');
                button.classList.add('bg-green-400', 'hover:bg-green-500');
            }
        }
    </script>
    </html>
</x-app-layout>
