<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans text-xs m-8">

    {{-- LOGO --}}
    <img src="{{ public_path('images/logo_perusahaan.png') }}" class="absolute top-8 left-8 w-12 rounded-full" alt="Logo Perusahaan">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h2 class="text-lg font-bold">PT MONDAR MANDIR</h2>
        <h3 class="text-red-700 font-semibold">Rekap Mutasi Stok Bulanan</h3>
        <p>Periode: {{ now()->format('d/m/Y') }}</p>
    </div>

    {{-- TABLE --}}
    <table class="w-full border border-black border-collapse mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Id Barang</th>
                <th class="border p-2">Nama Barang</th>
                <th class="border p-2">Unit</th>
                <th class="border p-2">Tipe</th>
                <th class="border p-2">Informasi</th>
                <th class="border p-2">Qty</th>
                <th class="border p-2">Produsen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $p)
                <tr class="text-center">
                    <td class="border p-2">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $p->id }}</td>
                    <td class="border p-2">{{ $p->product_name }}</td>
                    <td class="border p-2">{{ $p->unit }}</td>
                    <td class="border p-2">{{ $p->type }}</td>
                    <td class="border p-2">{{ $p->information }}</td>
                    <td class="border p-2">{{ $p->qty }}</td>
                    <td class="border p-2">{{ $p->producer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div class="mt-10 text-center text-[10px]">
        <table class="w-full">
            <tr>
                <td>Dilaksanakan Oleh</td>
                <td>Diketahui Oleh</td>
            </tr>
            <tr>
                <td class="pt-8">_________________<br>Logistik</td>
                <td class="pt-8">_________________<br>Kepala Depo</td>
            </tr>
        </table>
    </div>

</body>
</html>
