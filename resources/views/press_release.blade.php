<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Press Release</title>
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    </head>

    <style>
        .dataTables_wrapper {
            position: relative;
            overflow: auto;
        }
    
        table.dataTable {
            width: 100%; /* Pastikan tabel menggunakan lebar penuh */
        }
    
        table.dataTable thead th,
        table.dataTable tbody td {
            white-space: nowrap; /* Agar konten dalam cell tidak mempengaruhi layout */
            padding: 8px 16px; /* Tambahkan padding untuk jarak antar konten */
        }
    
        /* Sticky pada kolom kiri (Press Name) */
        table.dataTable tbody td:first-child,
        table.dataTable tbody td:nth-child(2) {
            position: sticky;
            left: 0;
            background-color: white; /* Background agar cell tidak overlap */
            z-index: 999; /* Z-index tinggi untuk menutupi elemen lain saat di scroll */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Efek bayangan agar cell terlihat menonjol */
        }
    
        table.dataTable thead th:first-child,
        table.dataTable thead th:nth-child(2) {
            position: sticky;
            left: 0;
            z-index: 1001; /* Z-index tinggi untuk menutupi elemen lain saat di scroll */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Efek bayangan agar cell terlihat menonjol */
        }
    
        /* Sticky pada kolom kanan (Action) */
        table.dataTable tbody td:last-child {
            position: sticky;
            right: 0;
            background-color: white; /* Background agar cell tidak overlap */
            z-index: 999; /* Z-index tinggi untuk menutupi elemen lain saat di scroll */
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1); /* Efek bayangan agar cell terlihat menonjol */
        }
    
        table.dataTable thead th:last-child {
            position: sticky;
            right: 0;
            z-index: 1001; /* Z-index tinggi untuk menutupi elemen lain saat di scroll */
            background-color: #007bff; /* Ganti warna background header menjadi biru */
            color: white; /* Warna teks putih agar kontras dengan background biru */
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1); /* Efek bayangan agar cell terlihat menonjol */
        }
    
        table.dataTable thead th {
            position: sticky;
            top: 0;
            z-index: 1000; /* Tetap di atas saat scroll ke bawah */
            background-color: #007bff; /* Ganti warna background header menjadi biru */
            color: white; /* Warna teks putih agar kontras dengan background biru */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Efek bayangan pada header */
        }
    
        table.dataTable tbody tr {
            background-color: white; /* Warna baris tetap putih */
        }
    
        /* CSS untuk memotong teks dengan tiga titik */
        table.dataTable tbody td {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    
        table.dataTable tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Warna selang-seling untuk baris */
        }
    
        .table-responsive {
            width: 100%;
            overflow-x: auto; /* Memungkinkan scroll horizontal */
            -webkit-overflow-scrolling: touch; /* Smooth scrolling untuk perangkat mobile */
        }
    
        /* Aturan untuk kolom default */
        .responsive-column {
            white-space: nowrap; /* Pastikan teks tidak membungkus secara default */
        }
    
        /* Untuk layar kecil */
        @media (max-width: 768px) {
            .responsive-column {
                white-space: normal; /* Izinkan teks membungkus */
                width: auto; /* Kolom mengambil lebar sesuai kebutuhan */
                word-break: break-word; /* Pisahkan kata panjang jika diperlukan */
            }
        }
    
        /* Custom style for Press Name column */
        table.dataTable th:nth-child(2),
        table.dataTable td:nth-child(2) {
            width: 150px; /* Atur lebar kolom Press Name, tidak auto */
            overflow: hidden;
            text-overflow: ellipsis; /* Teks yang melebihi batas akan dipotong dengan titik-titik */
            white-space: nowrap; /* Mencegah teks membungkus */
        }
    </style>
    
    
   
    
    
    <body class="bg-gray-100 font-sans antialiased">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Press Release') }}
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4 mb-10">
                <div class="container mx-auto mt-4 p-5 bg-white shadow-lg rounded-lg">
                    <h1 class="text-3xl font-extrabold text-center text-blue-600 mb-3">Press Release</h1>
    
                    <select id="filter-month" class="block w-full mt-2 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <option value="">All Months</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
    
                    <!-- Add Data Button -->
                    <div class="flex justify-end mb-6 mt-10">
                        <a href="{{ route('data.create') }}">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow-md">
                                Add Data
                            </button>
                        </a>
                    </div>
    
                    <!-- Table Section -->
                    <div class="table-responsive">
                        <table id="press-table" class="min-w-full bg-white border-collapse border border-gray-300 rounded-lg shadow-sm">
                            <thead class="bg-blue-500 text-white border border-gray-300">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300">Date</th>
                                    <th class="px-4 py-2 border border-gray-300">Press Name</th>
                                    <!-- <th class="px-4 py-2 border border-gray-300">Description</th> -->
                                    <th class="px-4 py-2 border border-gray-300">Kabarnusa</th>
                                    <th class="px-4 py-2 border border-gray-300">Baliportal</th>
                                    <th class="px-4 py-2 border border-gray-300">Updatebali</th>
                                    <th class="px-4 py-2 border border-gray-300">Pancarpos</th>
                                    <th class="px-4 py-2 border border-gray-300">Wartadewata</th>
                                    <th class="px-4 py-2 border border-gray-300">Baliexpress</th>
                                    <th class="px-4 py-2 border border-gray-300">Fajarbali</th>
                                    <th class="px-4 py-2 border border-gray-300">Balitribune</th>
                                    <th class="px-4 py-2 border border-gray-300">Radarbali</th>
                                    <th class="px-4 py-2 border border-gray-300">Dutabali</th>
                                    <th class="px-4 py-2 border border-gray-300">Baliekbis</th>
                                    <th class="px-4 py-2 border border-gray-300">Baliprawara</th>
                                    <th class="px-4 py-2 border border-gray-300">Baliwara</th>
                                    <th class="px-4 py-2 border border-gray-300">Balipost</th>
                                    <th class="px-4 py-2 border border-gray-300">Link Other</th>
                                    <th class="px-4 py-2 border border-gray-300">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <!-- DataTables will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#press-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true, // Tambahkan scrollX agar tabel bisa di-scroll horizontal
                fixedColumns: {
                    leftColumns: 2 // Kolom pertama (press_name) akan menjadi sticky di kiri
                },
                fixedHeader: true,
                ajax: {
                    url: '{{ route("data.press") }}',
                    data: function (d) {
                        d.month = $('#filter-month').val(); // Kirim filter bulan
                    }
                },
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'press_name', name: 'press_name', className: 'responsive-column' },
                    // { data: 'description', name: 'description' },
                    {
                        data: 'link_kabarnusa',
                        name: 'link_kabarnusa',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_baliportal',
                        name: 'link_baliportal',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_updatebali',
                        name: 'link_updatebali',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_pancarpos',
                        name: 'link_pancarpos',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_wartadewata',
                        name: 'link_wartadewata',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_baliexpress',
                        name: 'link_baliexpress',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_fajarbali',
                        name: 'link_fajarbali',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_balitribune',
                        name: 'link_balitribune',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_radarbali',
                        name: 'link_radarbali',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_dutabali',
                        name: 'link_dutabali',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_baliekbis',
                        name: 'link_baliekbis',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_baliprawara',
                        name: 'link_baliprawara',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_baliwara',
                        name: 'link_baliwara',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_balipost',
                        name: 'link_balipost',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'link_other',
                        name: 'link_other',
                        render: linkRenderer,
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false, // Tidak dapat dicari
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                                <div class="button-group flex md:flex-row flex-col gap-2">
                                    <button data-id="${data}" class="view-button px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button data-id="${data}" class="edit-button px-3 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-id="${data}" class="delete-button px-3 py-2 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            `;
                        }



                    }
                ],

                columnDefs: [
                {
                    targets: 1, // Target kolom kedua (Press Name)
                    width: '200px', // Tentukan lebar kolom secara eksplisit
                    className: 'text-left text-ellipsis', // Tambahkan kelas text-ellipsis
                },
            ],
                
                lengthMenu: [10, 25, 50],
                pageLength: 10,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        next: "Next",
                        previous: "Previous"
                    }
                },
                drawCallback: function() {
                    $('.dataTables_paginate .paginate_button').addClass('bg-gray-200 hover:bg-blue-500 text-gray-800');
                }
            });

            function linkRenderer(data) {
                if (data) {
                    // Tampilkan ikon centang hijau jika link ada
                    return `<a href="${data}" target="_blank" class="text-green-500 text-lg">
                                <i class="fas fa-check-circle"></i>
                            </a>`;
                } else {
                    // Tampilkan ikon silang merah jika link tidak ada
                    return `<span class="text-red-500 text-lg">
                                <i class="fas fa-times-circle"></i>
                            </span>`;
                }
            }




    
            // Event listener untuk filter bulan
            $('#filter-month').change(function() {
                table.draw();
            });

            
            $('#press-table').on('click', '.view-button', function () {
                const id = $(this).data('id');
                viewData(id);
            });

            $('#press-table').on('click', '.edit-button', function () {
                const id = $(this).data('id');
                editData(id);
            });

            $('#press-table').on('click', '.delete-button', function () {
                const id = $(this).data('id');
                deleteData(id);
            });

            function viewData(id) {
                window.location.href = `/data/${id}/view`;
            }

            function editData(id) {
                window.location.href = `/data/${id}/edit`;
            }

            function deleteData(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/data/${id}/delete`,
                            type: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $('#press-table').DataTable().ajax.reload();
                            },
                            error: function(error) {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete data!',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }



        });
    </script>
</body>
</html>
</x-app-layout>
