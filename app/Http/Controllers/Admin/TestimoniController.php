<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

 class TestimoniController extends Controller
{
    public function index()
    {
        // Use paginate instead of all
        $testimonis = Testimoni::paginate(10);
        return view('admin.testimoni.index', ['testimoni' => $testimonis]);
    }

    public function create()
    {
        return view('admin.testimoni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1|max:5',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'customer_name' => Auth::user()->name, // Automatically set from logged-in user
            'message'       => $request->message,
            'rating'        => $request->rating,
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimoni', 'public');
        }

        Testimoni::create($data);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.edit', ['testimoni' => $testimoni]);
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1|max:5',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'message' => $request->message,
            'rating'  => $request->rating,
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimoni', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diupdate!');
    }

    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus!');
    }
 
}




