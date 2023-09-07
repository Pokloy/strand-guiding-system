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
use DB;

class StrandController extends Controller
{
    function loadTemplate()
    {
        return view('pages.assessor.template');
    }

    function loadStrand()
    {
        // get strands for admin
        $strandList = StrandModel::all();

        // get strands for staff
        $strandList_s = StrandModel::where('status', 'Active')->get();

        $strands = array();

        foreach($strandList_s as $s)
        {
            //get questions to count per strand
            $q_per_strand = QuestionModel::where('strand_id', $s->strand_id)
                                                 ->get()
                                                 ->count();
            array_push($strands, 
                [
                    'strand_id' => $s->strand_id,
                    'code' => $s->code,
                    'name' => $s->name,
                    'count' => $q_per_strand
                ]);
        }



        return view('pages.assessor.strand', compact('strandList', 'strands'));
    }

    function addStrand(Request $r)
    {
        $strand = new StrandModel;
        $strand->name = $r->name;
        $strand->code = $r->code;
        $strand->status = $r->status;
        $strand->about = $r->about;
        $save_strand = $strand->save();

        if($save_strand)
        {
            return response()->json([
                'status' => true,
                'message' => 'saved',
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Error: Saving new strand failed. Please try again',
            ]);
        }
    }

    function fetchStrand(Request $r)
    {
        $findStrand = StrandModel::where('strand_id', '=', $r->id);
        $strand = $findStrand->first();

        if($strand)
        {
            return response()->json([
                'status' => true,
                'strand' => $strand,
                'message' => 'fetched',
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Error: Query resulted to empty',
            ]);
        }
    }

    function updateStrand(Request $r)
    {
        $strand = StrandModel::where('strand_id', '=', $r->id);                       
        $saved = $strand->update(
            [
               'name' => $r->name,
               'code' => $r->code,
               'status' => $r->status,
               'about' => $r->about
            ]
        );

        if($saved)
        {
            return response()->json([
                'status' => true,
                'message' => 'updated'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Error: Updating strand details failed'
            ]);
        }
    }

    function loadviewStrand($strand_id)
    {
        $strand = StrandModel::where('strand_id', '=', $strand_id)->first();
        $questions = StrandModel::join('tblquestion', 'tblstrand.strand_id', '=', 'tblquestion.strand_id')
                                ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                ->where('tblstrand.strand_id','=', $strand_id)
                                ->get();

        $items = $questions->count();

        return view('pages.assessor.view_strand', compact('strand', 'items'));
    }

    function searchStrand(Request $r)
    {
        $key = $r->key;
        $strands = StrandModel::where('name', 'LIKE', '%'.$key.'%')->get();
        return response()->json([
            'status' => true,
            'message' => 'searched',
            'strands' => $strands
        ]);
    }

    function countStrands()
    {
        $strand_codes = StrandModel::select('code')
                                   ->get();
        return response()->json([
            'status' => true,
            'message' => 'ready',
            'sCodes' => $strand_codes
        ]);
    }
}
