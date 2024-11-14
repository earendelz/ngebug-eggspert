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

    public function redirecting(Request $request){

          // Validate the incoming request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user using the provided credentials
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // If successful, the user is logged in via session
            // Session-based authentication is now active, so the user can pass the 'auth' middleware

            return response()->json([
                'status' => 200,
                'message' => 'Authenticated successfully. Redirecting...',
            ]);
        }

        // If authentication fails, return a response indicating failure
        return response()->json([
            'status' => 401,
            'message' => 'Authentication failed, please check your credentials.',
        ]);

       
    }
    
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
