<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
    Requests
*/


/*
    Models
*/
use App\Models\StrandModel;
use App\Models\QuestionModel;
use App\Models\AnswersModel;

class QuestionController extends Controller
{
    function viewQuestions(Request $r)
    {
        $questions = StrandModel::join('tblquestion', 'tblstrand.strand_id', '=', 'tblquestion.strand_id')
                                ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                ->where('tblstrand.strand_id','=', $r->strandid)
                                ->get();
        
        return response()->json([
            'status' => true,
            'message' => 'fetched',
            'questions' => $questions
        ]);
    }
    function addQuestion(Request $r)
    {

        $new_question = new QuestionModel();
        $new_question->question = $r->question;
        $new_question->answer = $r->answer;
        $new_question->strand_id = $r->strandid;
        $save_new_question = $new_question->save();

        if($save_new_question)
        {
            $answer = new AnswersModel();
            $answer->question_id = $new_question->id;
            $answer->choice1 = $r->c1;
            $answer->choice2 = $r->c2;
            $answer->choice3 = $r->c3;
            $answer->choice4 = $r->c4;

            $save_answer = $answer->save();

            if($save_answer)
            {
                return response()->json([
                    'status' => true,
                    'message' => 'added'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => true,
                    'message' => 'Error: Adding answers/choices failed'
                ]);
            }
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Error: Adding question failed'
            ]);
        }
    }

    function fetchQuestion(Request $r)
    {
        $question = StrandModel::join('tblquestion', 'tblstrand.strand_id', '=', 'tblquestion.strand_id')
                                ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                ->where('tblstrand.strand_id','=', $r->strandid)
                                ->where('tblquestion.question_id', '=', $r->questionid)
                                ->get();

        return response()->json([
            'status' => true,
            'message' => 'fetched',
            'question' => $question
        ]);
    }

    function updateQuestion(Request $r)
    {
        $question = QuestionModel::join("tblanswers", "tblquestion.question_id","=","tblanswers.question_id")
                                 ->where('tblquestion.question_id','=', $r->questionid);

        $updateQ = $question->update(
            [
                'question' => $r->question,
                'answer' => $r->answer,
                'choice1' => $r->c1,
                'choice2' => $r->c2,
                'choice3' => $r->c3,
                'choice4' => $r->c4,
            ]
        );
        if($updateQ)
        {
            return response()->json([
                'status' => true,
                'message' => 'updated',
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'not updated',
            ]);
        }

    }

    function deleteQuestion(Request $r)
    {
        $question = QuestionModel::where('tblquestion.question_id', '=', $r->questionid);
        $deleted = $question->delete();

        if($deleted)
        {
            return response()->json([
                'status' => true,
                'message' => 'deleted',
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'not deleted',
            ]);
        }
    }

    function getQ_answers(Request $r)
    {
        // get the questions with corresponding responses
        $question_w_resp = QuestionModel::join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                        ->where('tblquestion.question_id', '=', $r->questionid)
                                        ->first();
        if($question_w_resp)
        {
            return response()->json([
                'status' => true,
                'message' => 'responses fetched',
                'question' => $question_w_resp
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Error: Fetching questions and answers failed',
            ]);
        }
        
    }
}
