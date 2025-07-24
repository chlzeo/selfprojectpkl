<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MerekController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Merek::orderBy('name');

        // Cek apakah ada parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil hasil paginasi
        $merek = $query->paginate(10);

        return view('admin.merek.index', compact('merek'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.merek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:merek,name',
        ]);

        Merek::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.merek.index')->with('success', 'Merek berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Merek $merek)
    {
        // Not used for this simple CRUD
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merek $merek)
    {
        return view('admin.merek.edit', compact('merek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Merek $merek)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:merek,name,' . $merek->id,
        ]);

        $merek->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.merek.index')->with('success', 'Merek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Merek $merek)
    {
        $merek->delete();
        return redirect()->route('admin.merek.index')->with('success', 'Merek berhasil dihapus.');
    }
}