<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $gudangs = Gudang::where('id_peternak', $userId)->get();
        return view('gudang.index', compact('gudangs'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userId = Auth::id();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'egg_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        Gudang::create([
            'name' => $request->name,
            'date' => $request->date,
            'egg_count' => $request->egg_count,
            'chicken_breed' => $request->chicken_breed,
            'id_peternak' => $userId,
        ]);

        return redirect()->route('gudang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('gudang.show', compact('gudang'));
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('gudang.edit', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'egg_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
        ]);

        $gudang = Gudang::findOrFail($id);
        $gudang->update($request->all());

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        $gudang->delete();

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus.');
    }
}
