<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('RegisterPage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric|starts_with:9|min_digits:10|max_digits:10|unique:users,mobile_number',
            'password' => 'required|confirmed|min:9|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ]);

        if ($form->fails()) {
            return back()
                ->withErrors($form)
                ->withInput();
        }

        User::create([
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
            'status' => 'Active',
            'role' => 'Student',
        ]);

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return Inertia::render('AccountPage');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $form = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'mobile_number' => 'required|numeric|starts_with:9|min_digits:10|max_digits:10|unique:users,mobile_number,'.Auth::user()->id,
        ]);

        if ($form->fails()) {
            return back()
                ->withErrors($form)
                ->withInput();
        }

        User::where('id', Auth::user()->id)
            ->update([
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
            ]);

        Inertia::flash('successAccount', 'Account updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
