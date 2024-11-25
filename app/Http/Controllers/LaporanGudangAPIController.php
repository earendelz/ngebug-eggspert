<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\LaporanGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanGudangAPIController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Mengambil laporan-laporan yang terkait dengan gudang milik pengguna tersebut
        $laporan = LaporanGudang::with('gudang:id,nama')
            ->whereHas('gudang', function ($query) use ($userId) {
                $query->where('id_peternak', $userId); // Memastikan laporan hanya milik pengguna yang sedang login
            })
            ->get();
    
        return response()->json($laporan);
    }

    public function store(Request $request)
    {
        
        $userId = Auth::id();
        // Validasi request
        $validated = $request->validate([
            'id_gudang' => 'required|exists:gudang,id',
            'jumlah_telur' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tanggal_laporan_gudang' => 'required|date',
        ]);

        // Mengambil Gudang terkait
        $gudang = Gudang::findOrFail($validated['id_gudang']);
        
        // Pastikan jumlah telur tidak kurang dari yang ada di gudang
        if ($gudang->jumlah_telur < $validated['jumlah_telur']) {
            return response()->json(['error' => 'Jumlah telur yang dilaporkan melebihi jumlah telur yang ada di gudang.'], 400);
        }

        // Membuat laporan pengurangan telur
        $laporan = LaporanGudang::create([
            'id_gudang' => $validated['id_gudang'],
            'jumlah_telur' => $validated['jumlah_telur'],
            'keterangan' => $validated['keterangan'],
            'tanggal_laporan_gudang' => $validated['tanggal_laporan_gudang'],
            'id_peternak' => $userId
        ]);

        // Mengurangi jumlah telur pada Gudang
        $gudang->jumlah_telur -= $validated['jumlah_telur'];
        $gudang->save();

        return response()->json($laporan, 201);
    }

    public function show($id)
    {
        $laporan = LaporanGudang::with('gudang')
            ->where('id', $id)
            ->get();
        return response()->json($laporan);
    }

    public function update(Request $request, string $id)
    {
        $laporanGudang = LaporanGudang::findOrFail($id);
        
        $validated = $request->validate([
            'jumlah_telur' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tanggal_laporan_gudang' => 'required|date',
        ]);

        $laporanGudang->update($validated);

        // Kembalikan catatan yang diperbarui
        return response()->json($laporanGudang);
    }

    public function destroy($id)
    {
        $laporan = LaporanGudang::findOrFail($id);
        $laporan->delete();

        // Mengembalikan jumlah telur setelah laporan dihapus
        $gudang = Gudang::findOrFail($laporan->id_gudang);
        $gudang->jumlah_telur += $laporan->jumlah_telur;
        $gudang->save();

        return response()->json(null, 204);
    }

    public function showByIDLaporan(string $id)
    {
        $laporanGudang = LaporanGudang::with('gudang')
                        ->where('id', $id)
                        ->get();
        return response()->json($laporanGudang);
    }

}
