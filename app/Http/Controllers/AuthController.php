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

    public function redirectings(){
        return('redirect:/login');
    }
    
    public function logout(Request $request) {
         // For session-based authentication (web)
         if (Auth::check()) {
            Auth::logout(); // Logs out the user
            $request->session()->invalidate(); // Invalidate the session
            $request->session()->regenerateToken(); // Regenerate CSRF token to prevent session fixation attacks

            // Optionally, return a success message or redirect
            return response()->json(['message' => 'Logged out successfully.'], 200);
        }

        // For Sanctum API token logout
        if ($request->user()) {
            // Revoke the user's token
            $request->user()->tokens->each(function ($token) {
                $token->delete();
            });

            // Optionally, you can log the user out of the session as well (if they are logged in via session)
            Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
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
