<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAPIController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        //$products = Product::all();
        $products = Product::where('id_peternak', $userId)->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

<<<<<<< Updated upstream
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'chicken_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'chicken_count' => $request->chicken_count,
            'chicken_breed' => $request->chicken_breed,
            'id_peternak' => $request -> id_peternak,
=======
        $request->validate([
            'nama' => 'required|string|max:255|unique:products',
            'jenis_kandang' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'jumlah_ayam' => 'required|integer|min:1',
            'id_ras_ayam' => 'required|exists:ras_ayams,id',
            'id_pakan' => 'required|exists:pakans,id',
            'id_peternak' => 'required|exists:users,id',
            'status_pakan' => 'required|string|max:255',
        ]);

        $product = Product::create([
            'nama' => $request->nama,
            'jenis_kandang' => $request->jenis_kandang,
            'kapasitas' => $request->kapasitas,
            'jumlah_ayam' => $request->jumlah_ayam,
            'id_ras_ayam' => $request->id_ras_ayam,
            'id_pakan' => $request->id_pakan,
            'id_peternak' => $request->id_peternak,
            'status_pakan' => $request->status_pakan,
>>>>>>> Stashed changes
        ]);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
<<<<<<< Updated upstream
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'chicken_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
=======
            'nama' => $request->nama,
            'jenis_kandang' => $request->jenis_kandang,
            'kapasitas' => $request->kapasitas,
            'jumlah_ayam' => $request->jumlah_ayam,
            'id_ras_ayam' => $request->id_ras_ayam,
            'id_pakan' => $request->id_pakan,
            'id_peternak' => $request->id_peternak,
            'status_pakan' => $request->status_pakan,
>>>>>>> Stashed changes
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
