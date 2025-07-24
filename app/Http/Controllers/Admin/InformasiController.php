<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Informasi::with(['user', 'category'])->latest();

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
        $informasi = $query->paginate(10);

        return view('admin.informasi.index', compact('informasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // Pastikan view yang benar: 'admin.informasi.create'
        return view('admin.informasi.create', compact('categories'));
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
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Menyimpan langsung ke disk 'public' di folder 'informasi'
            $imagePath = $request->file('image')->store('informasi', 'public');
        }

        Informasi::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->boolean('status', false),
        ]);

        return redirect()->route('admin.informasi.index')->with('success', 'informasi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        // Pastikan view yang benar: 'admin.informasi.show'
        return view('admin.informasi.show', compact('informasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        // Pastikan hanya pemilik artikel atau admin yang bisa mengedit
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->id !== $informasi->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $categories = Category::all();
        // Pastikan view yang benar: 'admin.informasi.edit'
        return view('admin.informasi.edit', compact('informasi', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        // Pastikan hanya pemilik artikel atau admin yang bisa mengupdate
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->id !== $informasi->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $imagePath = $informasi->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($informasi->image) {
                Storage::disk('public')->delete($informasi->image); // Pastikan menghapus dari disk 'public'
            }
            // KOREKSI: Menyimpan langsung ke disk 'public' di folder 'informasi'
            $imagePath = $request->file('image')->store('informasi', 'public');
        } elseif ($request->input('remove_image')) {
            // Jika user memilih untuk menghapus gambar
            if ($informasi->image) {
                Storage::disk('public')->delete($informasi->image); //  Pastikan menghapus dari disk 'public'
                $imagePath = null;
            }
        }

        $informasi->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->boolean('status', false),
        ]);

        return redirect()->route('admin.informasi.index')->with('success', 'informasi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(informasi $informasi)
    {
        // Pastikan hanya pemilik artikel atau admin yang bisa menghapus
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->id !== $informasi->user_id && !$user->isAdmin()) {
            abort(403);
        }

        if ($informasi->image) {
            Storage::disk('public')->delete($informasi->image); //Pastikan menghapus dari disk 'public'
        }

        $informasi->delete();
        return redirect()->route('admin.informasi.index')->with('success', 'informasi deleted successfully.');
    }
}