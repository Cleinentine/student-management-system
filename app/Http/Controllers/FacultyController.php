<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $faculties = Faculty::select('faculties.id', 'faculties.name', 'users.id', 'users.status')
            ->join('users', 'users.id', 'faculties.user_id')
            ->where('faculties.dean_id', Auth::user()->dean->id)
            ->where('users.status', 'Active')
            ->orderBy('faculties.name', 'asc')
            ->get();

        return Inertia::render('FacultiesPage', ['faculties' => $faculties]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form = Validator::make($request->all(), [
            'name' => 'required|regex:/^[A-Za-z .,\'-]+$/',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:512',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric|starts_with:9|min_digits:10|max_digits:10|unique:users,mobile_number',
        ]);

        if ($form->fails()) {
            return back()
                ->withErrors($form)
                ->withInput();
        } else {
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
            } else {
                $path = null;
            }

            $user = User::create([
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => null,
                'status' => 'Active',
                'role' => 'Faculty',
            ]);

            $faculty = Faculty::create([
                'dean_id' => Auth::user()->dean->id,
                'user_id' => $user->id,
                'name' => $request->name,
                'avatar' => $path,
            ]);

            Password::sendResetLink([
                'email' => $user->email,
            ]);

            Inertia::flash('success', 'Faculty member added successfully and password reset email sent!');

            return redirect()
                ->back()
                ->with(['faculty' => $faculty]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::where('id', $request->user_id)
            ->update([
                'status' => 'Inactive',
            ]);

        return back();
    }
}
