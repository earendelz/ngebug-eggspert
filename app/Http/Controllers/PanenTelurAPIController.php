<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\PanenTelur;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PanenTelurAPIController extends Controller
{
    /**
     * menampilkan semua data panen telur
     */
    public function index()
    {
        $userId = Auth::id();
        $panenTelur = PanenTelur::with('kandang','gudang')
        ->where('id_peternak', $userId)
        ->get();
        return response()->json($panenTelur);
    }

    /**
     * menyimpan data panen telur baru
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        //validasi input yg diterima
        $validated = $request->validate([
            'jumlah_telur' => 'required|integer|min:1',
            'kondisi_telur' => 'required|string',
            'tanggal_panen' => 'required|date',
            'id_kandang' => 'required|exists:products,id', //validasi foreign key
            'id_gudang' => 'required|exists:gudang,id', //validasi foreign key
            'memo' => 'nullable|string',
        ]);

        // mengambil gudang yg terkait
        $gudang = Gudang::findOrFail($validated['id_gudang']);
        //menyimpan data baru
        $panenTelur = PanenTelur::create([
            'id_kandang' => $validated['id_kandang'],
            'id_gudang' => $validated['id_gudang'],
            'id_peternak' => $userId,
            'jumlah_telur' => $validated['jumlah_telur'],
            'kondisi_telur' => $validated['kondisi_telur'],
            'tanggal_panen' => $validated['tanggal_panen'],
            'memo' => $validated['memo']
        ]);

        // convert ke integer
        $validated['jumlah_telur'] = $validated['jumlah_telur'] + 0;
        $gudang->jumlah_telur += $validated['jumlah_telur'];
        $gudang->save();

        return response()->json($panenTelur, 201); //mengembalikan data yang baru dibuat
    }

    /**
     * menampilkan data panen telur by id
     */
    public function show(string $id)
    {
        $panenTelur = PanenTelur::with(['kandang', 'gudang'])
                        ->where('id', $id)
                        ->get();
        return response()->json($panenTelur);
    }

    /**
     * memperbarui data panen telur berdasarkan id
     */
    public function update(Request $request, string $id)
    {
        $panenTelur = PanenTelur::findOrFail($id);

        if (!$panenTelur) {
            return response()->json(['message' => 'Data panen telur tidak ditemukan'], 404);
        }

        //validasi input yg diterima
        $validated = $request->validate([
            'jumlah_telur' => 'required|integer',
            'kondisi_telur' => 'required|string',
            'tanggal_panen' => 'required|date',
            'id_kandang' => 'required|exists:products,id', //validasi foreign key
            'id_gudang' => 'required|exists:gudang,id', //validasi foreign key
            'memo' => 'nullable|string',
        ]);

        //memperbarui data
        $panenTelur->update($validated);

        //mengembalikan data yang baru dibuat
        return response()->json($panenTelur);
    }

    /**
     * menghapus data panen telur by id
     */
    public function destroy(string $id)
    {
        $panenTelur = PanenTelur::findOrFail($id);

        if(!$panenTelur){
            return response()->json(['message' => 'Data panen telur tidak ditemukan'], 404);
        }

        $panenTelur->delete();
        return response()->json(['message' => 'Data panen telur berhasil dihapus']);
    }

    public function getByKandang($id_kandang)
    {
        // Mengambil data panen telur berdasarkan id_kandang
        $panen_telur = PanenTelur::where('id_kandang', $id_kandang)->get();

        // Mengecek jika data tidak ditemukan
        if ($panen_telur->isEmpty()) {
            return response()->json(['message' => 'Data panen telur tidak ditemukan untuk kandang ini'], 404);
        }

        return response()->json($panen_telur);
    }


    public function getByNamaKandang($name)
    {
        // Cari kandang berdasarkan nama
        $kandang = Product::where('name', $name)->first();

        if (!$kandang) {
            return response()->json(['message' => 'Kandang dengan nama tersebut tidak ditemukan'], 404);
        }

        // Ambil data panen_telur yang berhubungan dengan kandang
        $panen_telur = PanenTelur::where('id_kandang', $kandang->id)->get();

        if ($panen_telur->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data panen telur untuk kandang ini'], 404);
        }

        return response()->json([
            'nama_kandang' => $kandang->name, //nama kandang
            'panen_telur' => $panen_telur, //data panen telur
        ]);
    }
}
