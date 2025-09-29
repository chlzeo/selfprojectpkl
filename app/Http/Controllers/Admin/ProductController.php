<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['user', 'category'])->latest();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Jika pengguna adalah author, hanya tampilkan artikel miliknya
        if ($user && $user->isAuthor()) {
            $query->where('user_id', $user->id);
        }

        // Cek apakah ada parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan 'title' artikel
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%');
            });
        }

        // Cek apakah ada parameter 'status' dalam request
        if ($request->has('status')) {
            // Pastikan status adalah boolean yang valid (0 atau 1)
            $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($status !== null) {
                $query->where('status', $status);
            }
        }

        // Ambil hasil paginasi
        $product = $query->paginate(10);

        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // Pastikan view yang benar: 'admin.product.create'
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'meta_desc' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048', // 2MB Max
            'status' => 'nullable|boolean',
            'price' => 'nullable|numeric|min:0', // Validasi harga
            'stock' => 'nullable|integer|min:0', // Validasi stok
            'sku' => 'nullable|string|max:255', // Validasi SKU jika diperlukan
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Menyimpan langsung ke disk 'public' di folder 'product'
            $imagePath = $request->file('image')->store('product', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->boolean('status', false),
            'price' => $request->input('price', null), // Pastikan harga diupdate jika ada
            'stock' => $request->input('stock', 0), // Pastikan stok diupdate jika ada
            'sku' => $request->input('sku', null), // Tambahkan SKU jika diperlukan
        ]);

        return redirect()->route('admin.product.index')->with('success', 'product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Pastikan view yang benar: 'admin.product.show'
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Pastikan hanya pemilik artikel atau admin yang bisa mengedit
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->id !== $product->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $categories = Category::all();
        // Pastikan view yang benar: 'admin.product.edit'
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Pastikan hanya pemilik artikel atau admin yang bisa mengupdate
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->id !== $product->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'status' => 'nullable|boolean',
            'price' => 'nullable|numeric|min:0', // Validasi harga
            'stock' => 'nullable|integer|min:0', // Validasi stok
            'sku' => 'nullable|string|max:255', // Validasi SKU jika diperlukan
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image); // Pastikan menghapus dari disk 'public'
            }
            // KOREKSI: Menyimpan langsung ke disk 'public' di folder 'product'
            $imagePath = $request->file('image')->store('product', 'public');
        } elseif ($request->input('remove_image')) {
            // Jika user memilih untuk menghapus gambar
            if ($product->image) {
                Storage::disk('public')->delete($product->image); //  Pastikan menghapus dari disk 'public'
                $imagePath = null;
            }
        }

        $product->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->boolean('status', false),
            'price' => $request->input('price', null), // Pastikan harga diupdate jika ada
            'stock' => $request->input('stock', 0), // Pastikan stok diupdate jika ada
            'sku' => $request->input('sku', null), // Tambahkan SKU jika diperlukan
        ]);

        return redirect()->route('admin.product.index')->with('success', 'product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Pastikan hanya pemilik artikel atau admin yang bisa menghapus
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->id !== $product->user_id && !$user->isAdmin()) {
            abort(403);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image); //Pastikan menghapus dari disk 'public'
        }

        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }
}