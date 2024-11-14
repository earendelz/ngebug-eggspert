<?php

namespace App\Http\Controllers;

use App\Models\RasAyam;
use Illuminate\Http\Request;

class RasAyamAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(RasAyam::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input yg diterima
        $request->validate([
            'nama_ras_ayam' => 'required|string|max:255',
            'jenis_ayam' => 'required|string|max:255',
        ]);

        //membuat objek ras_ayam baru
        $rasAyam = RasAyam::create([
            'nama_ras_ayam' => $request->nama_ras_ayam,
            'jenis_ayam' => $request->jenis_ayam,
        ]);

        //mengembalikan respons json dengan status 201 (created)
        return response()->json($rasAyam, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan ras_ayam berdasarkan id dengan findOrFail (otomatis mengembalikan eror 404 jika tidak ditemukan)
        $rasAyam = RasAyam::findOrFail($id);

        //mengembalikan respons json dengan data ras_ayam
        return response()->json($rasAyam);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi input yang diterima
        $request->validate([
            'nama_ras_ayam' => 'required|string|max:255',
            'jenis_ayam' => 'required|string|max:255',
        ]);

        //mencari ras_ayam berdasarkan id
        $rasAyam = RasAyam::findOrFail($id);

        //memperbarui data ras_ayam
        $rasAyam->update([
            'nama_ras_ayam' => $request->nama_ras_ayam,
            'jenis_ayam' => $request->jenis_ayam,
        ]);

        //mengembalikan respons json dengan data ras_ayam yang telah diperbarui
        return response()->json($rasAyam);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //mencari ras ayam berdasarkan id
        $rasAyam = RasAyam::findOrFail($id);

        //menghapus data ras ayam
        $rasAyam->delete();

        //mengembalikan respons json dengan pesan bahwa data telah dihapus
        return response()->json(['message' => 'Ras ayam berhasil dihapus']);
    }
}
