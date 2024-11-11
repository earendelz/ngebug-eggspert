<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Vaksinasi;  // Pastikan Anda memiliki model Vaksinasi
use Illuminate\Http\Request;

class VaksinasiAPIController extends Controller
{
    // Menampilkan semua data vaksinasi
    public function index(){
        $vaksinasi = Vaksinasi::all();    
        return response()->json($vaksinasi);
    }
    
    // Menyimpan data vaksinasi baru
    public function store(Request $request){
        $vaksinasi = new Vaksinasi();
        $vaksinasi->jenis_vaksin = $request->jenis_vaksin; 
        $vaksinasi->tanggal_vaksinasi = $request->tanggal_vaksinasi;
        $vaksinasi->id_product = $request->id_product;
        $vaksinasi->save();
        return response()->json($vaksinasi);
    }

    // Menampilkan data vaksinasi berdasarkan ID
    public function show(string $id){
        $vaksinasi = Vaksinasi::find($id);
        if (!$vaksinasi) {
            return response()->json(['message' => 'Vaksinasi not found'], 404);
        }
        return response()->json($vaksinasi);
    }

    // Mengupdate data vaksinasi
    public function update(Request $request, string $id) {
        // Mencari record vaksinasi
        $vaksinasi = Vaksinasi::find($id);
        if (!$vaksinasi) {
            return response()->json(['message' => 'Vaksinasi not found'], 404);
        }

        // Update data vaksinasi
        $vaksinasi->jenis_vaksin = $request->jenis_vaksin; 
        $vaksinasi->tanggal_vaksinasi = $request->tanggal_vaksinasi;
        $vaksinasi->id_product = $request->id_product;
        
        // Menyimpan perubahan
        $vaksinasi->save();
    
        // Mengembalikan data yang sudah diperbarui
        return response()->json($vaksinasi);
    }
    
    // Menghapus data vaksinasi
    public function destroy(string $id){
        $vaksinasi = Vaksinasi::find($id);
        if (!$vaksinasi) {
            return response()->json(['message' => 'Vaksinasi not found'], 404);
        }
        
        $vaksinasi->delete();
        return response()->json(['message' => 'Vaksinasi deleted']);
    }
}
