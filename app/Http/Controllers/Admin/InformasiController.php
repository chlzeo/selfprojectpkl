<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformasiController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Informasi::latest();

        // Cek apakah ada parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%');
            });
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
        return view('admin.informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        Informasi::create([
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->boolean('status', false),
        ]);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dibuat.');
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
        return view('admin.informasi.edit', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        $informasi->update([
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->boolean('status', false),
        ]);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}