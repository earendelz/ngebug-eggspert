<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Gudang;
use Illuminate\Http\Request;
use App\Models\User;

class GudangAPIController extends Controller
{

    public function index(){
        $gudang = Gudang::all();    
        return response()->json($gudang);
    }
    
    public function store(Request $request){
        $gudang = new Gudang();
        $gudang->name = $request->name; 
        $gudang->date = $request->date;
        $gudang->egg_count = $request->egg_count;
        $gudang->chicken_breed = $request->chicken_breed; 
        $gudang->id_peternak = $request->id_peternak;
        $gudang->save();
        return response()->json($gudang);
    }

    public function show(string $id){
        $gudang = Gudang::find($id);
        return response()->json($gudang);
    }

    public function update(Request $request, string $id) {
    
        // Find the Gudang record
        $gudang = Gudang::find($id);
        $gudang->name = $request->name; 
        $gudang->date = $request->date;
        $gudang->egg_count = $request->egg_count;
        $gudang->chicken_breed = $request->chicken_breed; 
        $gudang->id_peternak = $request->id_peternak;
    
        // Save the updated record
        $gudang->save();
    
        // Return the updated record
        return response()->json([$request]);
    }
    

    public function destroy(string $id){
        Gudang::destroy($id);
        return response()-> json(['message'=>'Deleted']);
    }

    public function getByUsername($username)
    {
        // Temukan user berdasarkan username
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Ambil laporan ayam berdasarkan user_id
        $gudang = Gudang::where('user_id', $user->id)->get();

        // Kembalikan laporan ayam sebagai respons
        return response()->json($gudang);
    }
    
}

