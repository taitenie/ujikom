<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'email' => 'required|email|unique:users',
            'birth' => 'required|date',
            'gender' => 'required',
            'address' => 'required|string',
            'city' => 'required|string',
            'number' => 'required|string',
            'paypalId' => 'nullable|string',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'birth' => $request->birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'number' => $request->number,
            'paypalId' => $request->paypalId,
            'role' => 'user',
        ]);

        // Optional: langsung login setelah register
        // auth()->login($user);

        return redirect()->route('login.form')->with('success', 'Registration successful!');
    }
}
