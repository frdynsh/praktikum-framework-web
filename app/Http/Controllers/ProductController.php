<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = Product::all();
        // return view('master-data.product-master.index-product', compact('data'));
        
        // Membuat query builder baru untuk model product
        $query = Product::query();
        $query = Product::with('supplier');

        // cek apakah ada parameter 'search' di request
        if ($request->has('search') && $request->search != '') {

            // Melakukan pencarian berdasarkan nama product atau informasi
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                ->orWhere('information', 'like', '%' . $search . '%');
            });
        }

        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }

        // PERTEMUAN 9
        $data = $query->paginate(3);
        return view('master-data.product-master.index-product', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('master-data.product-master.create-product', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi_data = $request->validate([
            'product_name' => 'required|max:255',
            'unit' => 'required|max:50',
            'type' => 'required|max:100',
            'information' => 'nullable',
            'qty' => 'required|integer',
            'producer' => 'required|max:100',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        Product::create($validasi_data);
        return redirect()->route('product-index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // PERTEMUAN 9
        $product = Product::findOrFail($id);
        return view('master-data.product-master.detail-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi_data = $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:100',
            'information' => 'nullable|string',
            'qty' => 'required|integer',
            'producer' => 'required|string|max:100',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validasi_data);
        return redirect()->route('product-index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('product-index')->with('success', 'Produk berhasil dihapus!');
        }
        return redirect()->route('product-index')->with('error', 'Produk tidak ditemukan.');
    }

    // PERTEMUAN 10
    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function exportPdf()
    {
        $products = Product::all();

        return Pdf::view('exports.products-pdf', compact('products'))
            ->format('a4')
            ->download('product-export.pdf');
    }

    public function exportJpg()
    {
        $products = Product::all();

        // Simpan tampilan Blade menjadi gambar JPG melalui Browsershot
        $imagePath = storage_path('app/product-export.jpg');

        Browsershot::html(view('exports.products-pdf', compact('products'))->render())
            ->windowSize(1280, 720)
            ->save($imagePath);

        return response()->download($imagePath, 'product-export.jpg');
    }
}
