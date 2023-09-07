<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
    Controllers
*/

/*
    Requests
*/

/*
    Models
*/

use App\Models\QuestionModel;
use App\Models\StrandModel;
use App\Models\StudentModel;
use App\Models\UserModel;

class HomeController extends Controller
{
    function loadHome()
    {
        $strand_count = StrandModel::all()->count();
        $question_count = QuestionModel::all()->count();
        $student_count = StudentModel::all()->count();
        $staff_count = UserModel::all()->count();

        return view('pages.assessor.home', compact('strand_count', 'question_count', 'student_count', 'staff_count'));
    }
}
