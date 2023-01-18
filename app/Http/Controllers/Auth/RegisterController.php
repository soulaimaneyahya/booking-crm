<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Registration form
     *
     * @return void
     */
    public function index()
    {
        return Inertia('Auth/Register');
    }

    /**
     * Store user & login()
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function store(RegisterRequest $request)
    {
        $user = $this->create($request->validated());
        Auth::login($user);
        return redirect()->route('listings.index')->with('success', 'Account created!');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}
