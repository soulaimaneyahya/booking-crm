<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia('Auth/Login');
    }

    public function store(LoginRequest $request)
    {
        // @method static bool attempt(array $credentials = [], bool $remember = false)
        if (!Auth::attempt($request->validated(), true)) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }
        $request->session()->regenerate();
        return redirect()->route('listings.index')->with('success', 'Login Success!');
    }
}
