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
        $products = Product::where('id_peternak', $userId)->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'chicken_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
            'status_kandang' => 'required|in:tersedia,tidak tersedia',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'chicken_count' => $request->chicken_count,
            'chicken_breed' => $request->chicken_breed,
            'status_kandang' => $request->status_kandang,
            'id_peternak' => $userId,
        ]);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $products = Product::where('id_peternak', $id)->get();
        return response()->json($products);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'chicken_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
            'status_kandang' => 'required|in:tersedia,tidak tersedia',
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
