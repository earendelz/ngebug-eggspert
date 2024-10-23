<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function signIn(Request $request) {
        $credentials = $request->only('username' ,'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('products')->with('success', 'Selamat datang!');
        }

        \Log::warning('Login attempt failed for:', $credentials);
        return redirect()->back()->withErrors(['username' => 'Username atau password salah.']);

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
