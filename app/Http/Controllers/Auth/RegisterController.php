<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
{
    // Validasi data yang diterima dari form registrasi
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'name' => 'nullable|string|max:255',
        'email' => 'required|email|max:255', // Include email field in validation rules
        'password' => 'required|string|min:8',
    ]);

    // Buat user baru berdasarkan data yang diterima
    $user = User::create([
        'username' => $validatedData['username'],
        'name' => $validatedData['name'],
        'email' => $validatedData['email'], // Access email field from validated data
        'password' => Hash::make($validatedData['password']),
    ]);

    // Redirect ke halaman login setelah registrasi berhasil
    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
}

    public function showRegisterForm()
    {
        return view('auth.register');
    }
}
