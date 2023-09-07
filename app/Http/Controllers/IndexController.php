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
use App\Models\StrandModel;
use App\Models\QuestionModel;

class IndexController extends Controller
{
    function loadIndex()
    {
        $count_questions = $this->getTotalNoQuestions();
        return view('index', compact('count_questions'));
    }

    function getTotalNoQuestions()
    {
        $questions = QuestionModel::all()->count();
        return $questions;
    }
}
