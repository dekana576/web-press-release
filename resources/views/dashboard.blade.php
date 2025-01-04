<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <x-welcome />
                <div class="mb-6 mt-5">
                    <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Filter Bulan -->
                        <div>
                            <label for="month" class="block text-sm font-medium text-gray-700">Pilih Bulan</label>
                            <select name="month" id="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Pilih Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Filter Tahun -->
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700">Pilih Tahun</label>
                            <select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Pilih Tahun</option>
                                @for ($y = date('Y'); $y >= 2000; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Button Filter -->
                        <div class="flex items-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 disabled:opacity-25 transition ease-in-out duration-150">
                                Filter
                            </button>
                        </div>
                    </form>

                </div>

                <!-- Tampilkan Total Data -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-md shadow">
                        <p class="text-lg font-semibold text-gray-700">Total Press Release</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalPressRelease }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-md shadow">
                        <p class="text-lg font-semibold text-gray-700">Press Release with Link</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $pressReleaseWithLink }}</p>
                    </div>
                    
                </div>

                <!-- Diagram Garis -->
                <div class="bg-white p-6 rounded-md shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Jumlah Link Press Release per Bulan</h3>
                    <canvas id="linkChart" class="w-full" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data labels untuk bulan
        var labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Data jumlah link per bulan (dikirim dari controller)
        var dataLinks = @json($linksPerMonth);

        var data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Link Press Release',
                data: dataLinks, // Data jumlah link per bulan
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        };

        var config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Render chart
        var linkChart = new Chart(
            document.getElementById('linkChart'),
            config
        );
    </script>
</x-app-layout>
