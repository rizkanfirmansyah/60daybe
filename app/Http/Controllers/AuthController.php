<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('contents.auth.login');
    }

    public function login(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = [
            $fieldType => $request->username,
            'password' => $request->password
        ];
        $user = User::where($fieldType, $request->username);
        if ($user->count() > 0) {
            if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
                // $request->session()->regenerate();
                return response()->json(['message' => 'Login berhasil', 'status' => 'success'], 200);
            } else {
                return response()->json(['message' => 'Login gagal, Username atau Password Salah!', 'status' => 'error'], 500);
            }
        } else {
            return response()->json(['message' => 'Login gagal, Username/email belum terdaftar!', 'status' => 'error'], 404);
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
