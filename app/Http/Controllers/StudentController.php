<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display the specified resource.
     * Show the form for creating a new resource.
     * Show the form for editing the specified resource.
     */
    public function index()
    {
        $programs = Program::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $student = Student::where('user_id', Auth::user()->id)
            ->first();

        return Inertia::render('StudentPage', ['programs' => $programs, 'student' => $student]);
    }

    /**
     * Store a newly created resource in storage.
     * Update the specified resource in storage.
     */
    public function storeUpdate(Request $request)
    {
        $form = Validator::make($request->all(), [
            'program_id' => 'required|numeric|exists:programs,id',
            'student_number' => 'required|regex:/^[0-9-]+$/|unique:students,student_number,'.Auth::user()->id,
            'first_name' => 'required|regex:/^[A-Za-z .,\'-]+$/',
            'middle_name' => 'required|regex:/^[A-Za-z .,\'-]+$/',
            'last_name' => 'required|regex:/^[A-Za-z .,\'-]+$/',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date|before_or_equal:-16 years',
            'home_address' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:512',
        ]);

        if ($form->fails()) {
            return back()
                ->withErrors($form)
                ->withInput();
        } else {
            $path = null;

            if ($request->hasFile('avatar')) {
                if (Auth::user()->student && Auth::user()->student->avatar && Storage::disk('public')->exists(Auth::user()->student->avatar)) {
                    Storage::disk('public')->delete(Auth::user()->student->avatar);
                }

                $path = $request->file('avatar')->store('avatars', 'public');
            }

            $student = Student::updateOrCreate([
                'user_id' => Auth::user()->id,
            ], [
                'program_id' => $request->program_id,
                'section_id' => null,
                'user_id' => Auth::user()->id,
                'student_number' => $request->student_number,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'home_address' => $request->home_address,
                'avatar' => $path ?? Auth::user()->student->avatar,
            ]);

            Inertia::flash('success', 'Profile updated successfully!');

            return redirect()
                ->back()
                ->with(['student' => $student]);
        }
    }
}
