<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $products = Product::where('id_peternak', $userId)->get();
        return view("products.index", compact("products"));
    }

    public function create()
    {
        return view("products.create");
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'chicken_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
        ]);

        Product::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'chicken_count' => $request->chicken_count,
            'chicken_breed' => $request->chicken_breed,
            'id_peternak' => $userId,
        ]);

        return redirect()->route('products.index')->with('success', 'Kandang berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Kandang berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }


}
