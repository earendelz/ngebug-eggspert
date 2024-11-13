<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['success' => true, 'data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $newUser = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        if ($newUser) {
            $token = $newUser->createToken('eggspert-app')->plainTextToken;
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Registration success',
                'data' => [
                    'token' => $token,
                    'user' => $newUser,
                ]
            ], 201);
        } else {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->save();

        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        User::destroy($id);
        return response()->json(['success' => true, 'message' => 'User Deleted Successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Retrieve credentials from request
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Generate token
            $token = Auth::user()->createToken('eggspert-app')->plainTextToken;
#kemungkinannya gara gara ngirim tiga token
            // Return a successful response with token
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'user' => Auth::user(),
                ]
            ])
            ->cookie('user_token', $token, 60, null, null, false, true)
            ;  // Send token in cookie
        }

        // If authentication fails
        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Invalid credentials',
        ], Response::HTTP_UNAUTHORIZED);
    }


    // Logout a user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
