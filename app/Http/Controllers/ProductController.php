<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Make the API request to the protected route with the Bearer token
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . Session::get('auth_token'),  // Using token stored in session
            ])->get('http://127.0.0.1:8000/api/products');
    
            // Handle API response
            if ($response->successful()) {
                $data = $response->json();
                return view('kandang_ayam', compact('data'));  // Return the view with the data
            } else {
                // Handle API error (e.g., token expired or invalid)
                Session::forget('auth_token');
                return redirect('/login')->with('error', 'Your session has expired. Please login again.');
            }
        } else {
            return redirect('/login');  // Redirect to login if the user is not authenticated
        }
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
