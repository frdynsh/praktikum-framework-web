<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="m-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="overflow-x-auto">

            <!-- ALERT SWEETALERT -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            @if (session('success'))
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
            </script>
            @endif

            @if (session('error'))
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
            </script>
            @endif

            <!-- PERTEMUAN 9 -->
            <form method="GET" action="{{ route('product-index') }}" class="mb-4 flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="cari produk.." class="w-1/4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="submit" class="ml-2 rounded-lg bg-green-500 px-4 py-2 text-white shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Cari
                </button>
            </form>

            <!-- TOMBOL ADD PRODUCT -->
            <a href="{{ route('product-create') }}">
                <button
                    class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Add product data
                </button>
            </a>
            <a href="{{ route('product-export-excel') }}">
                <button
                    class="px-6 py-4 text-white bg-blue-500 border border-blue-500 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Export to Excel
                </button>
            </a>
            <a href="{{ route('product-export-pdf') }}">
                <button
                    class="px-6 py-4 text-white bg-red-500 border border-red-500 rounded-lg shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Export to PDF
                </button>
            </a>
            <a href="{{ route('product-export-jpg') }}">
                <button
                    class="px-6 py-4 text-white bg-yellow-500 border border-yellow-500 rounded-lg shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    Export to JPG
                </button>
            </a>



            <!-- TABEL DATA PRODUK -->
            <table class="mt-5 min-w-full border border-collapse border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Product Name</th>

                        <!-- SORTING -->
                        @php
                            $currentSort = request('sort');
                            $currentDirection = request('direction') === 'asc' ? 'asc' : 'desc';
                            $columns = ['unit' => 'Unit', 'type' => 'Type', 'information' => 'Information', 'qty' => 'Qty', 'producer' => 'Producer'];
                        @endphp

                        <!-- LOOPING UNTUK TIAP KOLOM SORTING -->
                        @foreach ($columns as $key => $label)
                            <th class="px-4 py-2 border text-gray-600">
                                <a href="{{ route('product-index', [
                                        'sort' => $key,
                                        'direction' => ($currentSort === $key && $currentDirection === 'asc') ? 'desc' : 'asc',
                                        'search' => request('search')
                                    ]) }}" 
                                    class="flex items-center justify-between text-gray-700 hover:text-green-600">

                                    <span>{{ $label }}</span>
                                    <!-- ICON PANAH -->
                                    @if ($currentSort === $key)
                                        @if ($currentDirection === 'asc')
                                            <!-- Panah atas -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.23 10.977a.75.75 0 001.06.023L10 7.289l3.71 3.711a.75.75 0 101.06-1.06L10 5.7 6.29 9.9a.75.75 0 00-.023 1.037z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <!-- Panah bawah -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M14.77 9.023a.75.75 0 00-1.06-.023L10 12.711 6.29 8.999a.75.75 0 10-1.06 1.06L10 14.3l4.24-4.24a.75.75 0 00-.023-1.037z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    @else
                                        <!-- Default panah abu-abu -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a.75.75 0 01.53.22l3.75 3.75a.75.75 0 11-1.06 1.06L10 4.81 6.78 8.03a.75.75 0 11-1.06-1.06L9.47 3.22A.75.75 0 0110 3zm0 14a.75.75 0 01-.53-.22l-3.75-3.75a.75.75 0 111.06-1.06L10 15.19l3.22-3.22a.75.75 0 111.06 1.06L10.53 16.78A.75.75 0 0110 17z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </a>
                            </th>
                        @endforeach

                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($data as $item)
                        <tr class="bg-white">
                            <td class="px-4 py-2 border border-gray-200">{{ $item->id }}</td>
                            <td class="px-4 py-2 border border-gray-200 hover:text-blue-500 hover:underline">
                                <a href="{{ route('product-detail', $item->id) }}">
                                    {{ $item->product_name }}
                                </a>
                            </td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->unit }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->type }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->information }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->qty }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->producer }}</td>
                            <td class="px-4 py-2 border border-gray-200">
                                <a href="{{ route('product-edit', $item->id) }}"
                                    class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                                <button class="px-2 text-red-600 hover:text-red-800"
                                    onclick="confirmDelete('{{ route('product-deleted', $item->id) }}')">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-red-500 font-semibold">
                                Produk tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- PAGINATION -->
            <div class="mt-4">
                {{ $data->appends(['search' => request('search'), 'sort' => request('sort'), 'direction' => request('direction')])->links() }}
            </div>
        </div>
    </div>

    <!-- KONFIRMASI DELETE -->
    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form POST DELETE seperti semula
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
