<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Program;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $colleges = College::get();

        $postGraduates = Program::where('college_id', '=', 8)
            ->orderBy('name', 'asc')
            ->get();

        $underGraduates = Program::where('college_id', '!=', 8)
            ->orderBy('name', 'asc')
            ->get();

        return Inertia::render('HomePage', ['colleges' => $colleges, 'postGraduates' => $postGraduates, 'underGraduates' => $underGraduates]);
    }
}
