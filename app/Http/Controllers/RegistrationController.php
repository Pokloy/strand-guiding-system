<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
    Controllers
*/
use App\Http\Controllers\IndexController;

/*
    Requests
*/
use App\Http\Requests\RegisterRequest;

/*
    Models
*/
use App\Models\VerificationModel;
use App\Models\StudentModel;
use App\Models\StrandModel;
use App\Models\QuestionModel;
use App\Models\Student_ExamModel;
use App\Models\Student_Exam_DetailsModel;

class RegistrationController extends Controller
{
    function loadRegistrationpage()
    {
        return view('registration');
    }

    #region randomized questions from different strands

        #region stem questions

            function randomize_Q_stem()
            {
                // fetch the questions from stem strand
                $stem_examQ_ids = StrandModel::select('tblquestion.question_id')
                                                ->join('tblquestion', 'tblstrand.strand_id', '=', 'tblquestion.strand_id')
                                                ->where('tblstrand.code', '=', "STEM")
                                                ->get();

                // get all the ids of the questions that was being fetched
                $list_of_ids = array();
                foreach($stem_examQ_ids as $id)
                {
                    array_push($list_of_ids, $id->question_id);
                }

                //pick questions in random order
                // randomize the id
                shuffle($list_of_ids);

                $random_Q_id = array();
                $max_item_questions = 5;

                for($i=1;$i<=$max_item_questions;$i++)
                {
                    // pick at the end of the array and delete. then store to new array
                    $id = array_pop($list_of_ids);
                    array_push($random_Q_id, $id);
                }

                return $random_Q_id;
            }

        #endregion

        #region gas questions

            function randomize_Q_gas()
            {
                // fetch the questions from stem strand
                $gas_examQ_ids = StrandModel::select('tblquestion.question_id')
                                                ->join('tblquestion', 'tblstrand.strand_id', '=', 'tblquestion.strand_id')
                                                ->where('tblstrand.code', '=', "GAS")
                                                ->get();

                // get all the ids of the questions that was being fetched
                $list_of_ids = array();
                foreach($gas_examQ_ids as $id)
                {
                    array_push($list_of_ids, $id->question_id);
                }

                //pick questions in random order
                // randomize the id
                shuffle($list_of_ids);

                $random_Q_id = array();
                $max_item_questions = 5;

                for($i=1;$i<=$max_item_questions;$i++)
                {
                    // pick at the end of the array and delete. then store to new array
                    $id = array_pop($list_of_ids);
                    array_push($random_Q_id, $id);
                }

                return $random_Q_id;
            }

        #endregion

        #region abm questions

            function randomize_Q_abm()
            {
                // fetch the questions from stem strand
                $abm_examQ_ids = StrandModel::select('tblquestion.question_id')
                                                ->join('tblquestion', 'tblstrand.strand_id', '=', 'tblquestion.strand_id')
                                                ->where('tblstrand.code', '=', "ABM")
                                                ->get();

                // get all the ids of the questions that was being fetched
                $list_of_ids = array();
                foreach($abm_examQ_ids as $id)
                {
                    array_push($list_of_ids, $id->question_id);
                }

                //pick questions in random order
                // randomize the id
                shuffle($list_of_ids);

                $random_Q_id = array();
                $max_item_questions = 5;

                for($i=1;$i<=$max_item_questions;$i++)
                {
                    // pick at the end of the array and delete. then store to new array
                    $id = array_pop($list_of_ids);
                    array_push($random_Q_id, $id);
                }

                return $random_Q_id;
            }

        #endregion

        #region humss questions

            function randomize_Q_humss()
            {
                // fetch the questions from stem strand
                $humss_examQ_ids = StrandModel::select('tblquestion.question_id')
                                                ->join('tblquestion', 'tblstrand.strand_id', '=', 'tblquestion.strand_id')
                                                ->where('tblstrand.code', '=', "HUMSS")
                                                ->get();

                // get all the ids of the questions that was being fetched
                $list_of_ids = array();
                foreach($humss_examQ_ids as $id)
                {
                    array_push($list_of_ids, $id->question_id);
                }

                //pick questions in random order
                // randomize the id
                shuffle($list_of_ids);

                $random_Q_id = array();
                $max_item_questions = 5;

                for($i=1;$i<=$max_item_questions;$i++)
                {
                    // pick at the end of the array and delete. then store to new array
                    $id = array_pop($list_of_ids);
                    array_push($random_Q_id, $id);
                }

                return $random_Q_id;
            }
            
        #endregion

    #endregion
    
    function generateVerificationCode($length) {
        $characters = '0156789000546567254775475213213874132123000545544512217866641312164654657187788711324687321534134687894563213213110135465457234565678975678989';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function register(RegisterRequest $r)
    {
        //get verification code
        $verification_code = $this->generateVerificationCode(4);

        //save new verification details
        $new_verif = new VerificationModel();
        $new_verif->verification_code = $verification_code;
        $save_new_verif = $new_verif->save();

        if($save_new_verif)
        {
            $new_student = new StudentModel();
            $new_student->firstname = $r->input_fname;
            $new_student->lastname = $r->input_lname;
            $new_student->email = $r->input_email;
            $new_student->verification_id = $new_verif->id;
            $save_new_student = $new_student->save();
        }

        // get all the existing id of the questions for stem
        if($save_new_student)
        {
            $student_id = $new_student->id;

            // get all the existing id of the questions for stem and randomized

                $student_exam_stem_Qid= array();
                $student_exam_stem_Qid = $this->randomize_Q_stem();

                $student_exam_gas_Qid= array();
                $student_exam_gas_Qid = $this->randomize_Q_gas();

                $student_exam_abm_Qid= array();
                $student_exam_abm_Qid = $this->randomize_Q_abm();

                $student_exam_humss_Qid= array();
                $student_exam_humss_Qid = $this->randomize_Q_humss();

                // save to exam_details table
                $student_exam_detail = new Student_Exam_DetailsModel();
                $student_exam_detail->student_id = $student_id;
                $student_exam_detail->save();

                $student_exam_detail_id = $student_exam_detail->id;

                // save to exam table for stem
                foreach($student_exam_stem_Qid as $id)
                {
                    $student_exam = new Student_ExamModel();
                    $student_exam->student_id = $student_id;
                    $student_exam->question_id = $id;
                    $student_exam->student_exam_details_id = $student_exam_detail_id;
                    $student_exam->save();
                }

                // save to exam table for humss
                foreach($student_exam_humss_Qid as $id)
                {
                    $student_exam = new Student_ExamModel();
                    $student_exam->student_id = $student_id;
                    $student_exam->question_id = $id;
                    $student_exam->student_exam_details_id = $student_exam_detail_id;
                    $student_exam->save();
                }

                // save to exam table for gas
                foreach($student_exam_gas_Qid as $id)
                {
                    $student_exam = new Student_ExamModel();
                    $student_exam->student_id = $student_id;
                    $student_exam->question_id = $id;
                    $student_exam->student_exam_details_id = $student_exam_detail_id;
                    $student_exam->save();
                }

                // save to exam table for abm
                foreach($student_exam_abm_Qid as $id)
                {
                    $student_exam = new Student_ExamModel();
                    $student_exam->student_id = $student_id;
                    $student_exam->question_id = $id;
                    $student_exam->student_exam_details_id = $student_exam_detail_id;
                    $student_exam->save();
                }

            // get all the existing id of the questions for humss and randomized

            // session()->put('student_id', $student_id);
            // session()->pull('assessment_status');
            // return redirect()->route('preassessment');
            
            // session()->put('verification_code', $verification_code);
            session()->put('email_to_verify', $r->input_email);
            session()->put('verification_id', $new_verif->id);
            //sessiont()->put('student_id', $student_id);
            return redirect('verification');
        }
    }

    // cancel assessment
    function unregister(Request $r)
    {

        if($r->view == "preassessment")
        {
            StudentModel::where('student_id', $r->student_id)->delete();
            session()->pull('student_id');
            session()->pull('assessment_status');
        }
        else if($r->view == "verification")
        {
            $last_student = StudentModel::all()->sortDesc()->first();
            $student_id = $last_student->student_id;

            StudentModel::where('student_id', $student_id)->delete();
            session()->pull('email_to_verify');
            session()->pull('verification_id');
        }

        return response()->json([
            'status' => true,
            'message' => 'cancelled'
        ]);
        
    }

    function verifyEmail()
    {
        $verif_id = session()->get('verification_id');
        $email = session()->get('email_to_verify');
        return view('email_verification', compact('verif_id', 'email'));
    }

    function loadVerificationEmailTemplate()
    {
        return view('verification_email_template');
    }
    
    function fetchVerificationDetails(Request $r)
    {
        $verification_details = VerificationModel::where('verification_id', '=', $r->verif_id)->get();

        return response()->json([
            'status' => true,
            'message' => "fetched",
            'vdetails' => $verification_details
        ]);
    }

    function resendVerification_validate()
    {
        $verif_id = session()->get('verification_id');
        $verification_details = VerificationModel::where('verification_id', '=', $verif_id)->first();

        $is_sent = (int)$verification_details->is_sent;
        return response()->json([
            'status' => true,
            'message' => "validated",
            'is_sent' => $is_sent
        ]);
    }

    function updateVerificationDetails(Request $r)
    {
        $verif_id = $r->verif_id;

        $verification_details = VerificationModel::where("verification_id", "=", $verif_id);
        $update_verification_details = $verification_details->update(
            [
                'is_sent' => 1
            ]
        );

        return response()->json([
            'status' => true,
            'message' => "updated"
        ]);
    }

    function verifyRegistration(Request $r)
    {
        $verif_id = $r->verif_id;
        $verif_code = $r->verif_code;
        $validate_verification = VerificationModel::join('tblstudent', 'tblverification.verification_id', '=', 'tblstudent.verification_id')
                                                  ->where('tblverification.verification_id', '=', $verif_id)
                                                  ->where('tblverification.verification_code', '=', $verif_code);

        $count = $validate_verification->count();
        $vdetails = $validate_verification->first();
        if($count > 0)
        {
            $update_vdetails = $validate_verification->update(
                [
                    'is_verified' => 1
                ]
            );

            if($update_vdetails)
            {
                $student_id = $vdetails->student_id;
                session()->pull('verification_id');
                session()->put('student_id', $student_id);
                return response()->json([
                    'status' => true,
                    'message' => 'valid',
                ]);
            }
        }
        else
        {
            return response()->json([
                'status' => true,
                'message' => 'invalid_code'
            ]);
        }
    }
}
