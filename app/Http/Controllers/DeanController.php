<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Dean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DeanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colleges = College::orderBy('name', 'asc')
            ->get();

        $dean = Dean::where('user_id', Auth::user()->id)
            ->first();

        return Inertia::render('DeanPage', ['colleges' => $colleges, 'dean' => $dean]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dean $dean)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dean $dean)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $form = Validator::make($request->all(), [
            'college_id' => 'required|numeric|exists:colleges,id',
            'name' => 'required|regex:/^[A-Za-z .,\'-]+$/',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:512',
        ]);

        if ($form->fails()) {
            return back()
                ->withErrors($form)
                ->withInput();
        } else {
            $path = null;

            if ($request->hasFile('avatar')) {
                if (Auth::user()->student && Auth::user()->dean->avatar && Storage::disk('public')->exists(Auth::user()->dean->avatar)) {
                    Storage::disk('public')->delete(Auth::user()->dean->avatar);
                }

                $path = $request->file('avatar')->store('avatars', 'public');
            }

            $dean = Dean::where('user_id', Auth::user()->id)
                ->update([
                    'college_id' => $request->college_id,
                    'name' => $request->name,
                    'avatar' => $path ?? Auth::user()->dean->avatar,
                ]);

            Inertia::flash('success', 'Profile updated successfully!');

            return redirect()
                ->back()
                ->with(['student' => $dean]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dean $dean)
    {
        //
    }
}
