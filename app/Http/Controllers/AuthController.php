<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    // public function login(Request $request) {
    //     $validated = $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
        
    //     $data = [
    //         'username' => $validated['username'],
    //         'password' => $validated['password']
    //     ];

    //     $response = Http::post('http://127.0.0.1:8000/api/login', $data);
    //     if ($response -> successful()){
    //         $responseData = $response->json();
    //         $token = $responseData['data']['token'];   
    //         Session::put('auth_token', $token);
    //         return redirect()->route('kandang-ayam');
    //     } else {
    //         return response()->json([
    //             'message' => 'wrong password',
    //             'error' => $response->json(),
    //         ], 400);
    //         }
    // }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    public function register() {
        return view('register');
    }

    public function storeAccount(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'status_aktif' => 1,
            
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');

    }
}
