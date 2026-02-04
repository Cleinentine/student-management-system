<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function connect(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function login()
    {
        return Inertia::render('LoginPage');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function update(Request $request)
    {
        $form = Validator::make($request->all(), ['password' => 'required|confirmed|min:9|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/']);

        if ($form->fails()) {
            return back()
                ->withErrors($form)
                ->withInput();
        }

        User::where('id', Auth::user()->id)
            ->update(['password' => Hash::make($request->password)]);

        Inertia::flash('successPassword', 'Password updated successfully!');

        return back();
    }
}
