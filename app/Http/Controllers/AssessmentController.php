<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
    Controllers
*/
use App\Http\Controllers\AssessmentController;
/*
    Requests
*/
use App\Http\Requests\RegisterRequest;

/*
    Models
*/
use App\Models\StudentModel;
use App\Models\StrandModel;
use App\Models\QuestionModel;
use App\Models\AnswersModel;
use App\Models\Student_ExamModel;
use App\Models\Student_Exam_DetailsModel;


class AssessmentController extends Controller
{
    function createdummyQuestions_Strands()
    {
        // stem ============================================================================================================================
        // resources: http://www.csun.edu/science/ref/games/questions/97_genr.pdf

            $strand_stem = new StrandModel();
            $strand_stem->name = "Science, Technology Engineering and Mathematics";
            $strand_stem->code = "STEM";
            $strand_stem->status = "Active";
            $strand_stem->about = "The STEM Strand is for SHS students who are inclined toward or have the aptitude for Math or Science or Engineering studies.Science, Technology, Engineering, and Mathematics are intertwining disciplines when applied in the real world. The difference of the STEM curriculum with the other strands and tracks is the focus on advanced concepts and topics. Under the track, you can become a pilot, an architect, an astrophysicist, a biologist, a chemist, an engineer, a dentist, a nutritionist, a nurse, a doctor, and a lot more.";
            $strand_stem->save();

            // stem question 1
                $stem_q1 = new QuestionModel();
                $stem_q1->question = "Pollination by birds is called:";
                $stem_q1->answer = "ornithophily";
                $stem_q1->strand_id = $strand_stem->id;
                $stem_q1->save();

                $stem_q1_c = new AnswersModel();
                $stem_q1_c->choice1 = "autogamy";
                $stem_q1_c->choice2 = "ornithophily";
                $stem_q1_c->choice3 = "entomophily";
                $stem_q1_c->choice4 = "anemophily";
                $stem_q1_c->question_id = $stem_q1->id;
                $stem_q1_c->save();
            // stem question 1

            // stem question 2
                $stem_q2 = new QuestionModel();
                $stem_q2->question = "Unlike rodents, the rabbit has how many incisor teeth?";
                $stem_q2->answer = "4";
                $stem_q2->strand_id = $strand_stem->id;
                $stem_q2->save();

                $stem_q2_c = new AnswersModel();
                $stem_q2_c->choice1 = "4";
                $stem_q2_c->choice2 = "2";
                $stem_q2_c->choice3 = "6";
                $stem_q2_c->choice4 = "8";
                $stem_q2_c->question_id = $stem_q2->id;
                $stem_q2_c->save();
            // stem question 2

            // stem question 3
                $stem_q3 = new QuestionModel();
                $stem_q3->question = "To what familiar fruit is the plantain similar?";
                $stem_q3->answer = "Banana";
                $stem_q3->strand_id = $strand_stem->id;
                $stem_q3->save();

                $stem_q3_c = new AnswersModel();
                $stem_q3_c->choice1 = "Apple";
                $stem_q3_c->choice2 = "Grapes";
                $stem_q3_c->choice3 = "Orange";
                $stem_q3_c->choice4 = "Banana";
                $stem_q3_c->question_id = $stem_q3->id;
                $stem_q3_c->save();
            // stem question 3

            // stem question 4
                $stem_q4 = new QuestionModel();
                $stem_q4->question = "How many men have walked on the moon?";
                $stem_q4->answer = "12";
                $stem_q4->strand_id = $strand_stem->id;
                $stem_q4->save();

                $stem_q4_c = new AnswersModel();
                $stem_q4_c->choice1 = "2";
                $stem_q4_c->choice2 = "15";
                $stem_q4_c->choice3 = "12";
                $stem_q4_c->choice4 = "13";
                $stem_q4_c->question_id = $stem_q4->id;
                $stem_q4_c->save();
            // stem question 4

            // stem question 5
                $stem_q5 = new QuestionModel();
                $stem_q5->question = "The fastest-running terrestrial animal is:";
                $stem_q5->answer = "cheetah";
                $stem_q5->strand_id = $strand_stem->id;
                $stem_q5->save();

                $stem_q5_c = new AnswersModel();
                $stem_q5_c->choice1 = "cheetah";
                $stem_q5_c->choice2 = "lion";
                $stem_q5_c->choice3 = "man";
                $stem_q5_c->choice4 = "jaguar";
                $stem_q5_c->question_id = $stem_q5->id;
                $stem_q5_c->save();
            // stem question 5

            // stem question 6
                $stem_q6 = new QuestionModel();
                $stem_q6->question = "In what country do the greatest number of tornadoes occur?";
                $stem_q6->answer = "United States";
                $stem_q6->strand_id = $strand_stem->id;
                $stem_q6->save();

                $stem_q6_c = new AnswersModel();
                $stem_q6_c->choice1 = "Germany";
                $stem_q6_c->choice2 = "Singapore";
                $stem_q6_c->choice3 = "United States";
                $stem_q6_c->choice4 = "Brazil";
                $stem_q6_c->question_id = $stem_q6->id;
                $stem_q6_c->save();
            // stem question 6

            // stem question 7
                $stem_q7 = new QuestionModel();
                $stem_q7->question = "Which sea is the saltiest natural lake and is also at the lowest elevation on the face of the earth?";
                $stem_q7->answer = "The Dead Sea";
                $stem_q7->strand_id = $strand_stem->id;
                $stem_q7->save();

                $stem_q7_c = new AnswersModel();
                $stem_q7_c->choice1 = "The Dead Sea";
                $stem_q7_c->choice2 = "The Alive Sea";
                $stem_q7_c->choice3 = "Red Sea";
                $stem_q7_c->choice4 = "Blue Sea";
                $stem_q7_c->question_id = $stem_q7->id;
                $stem_q7_c->save();
            // stem question 7
        // stem ============================================================================================================================


        // abm ============================================================================================================================
        // resources: https://quizizz.com/admin/quiz/605ae7927d6403001b46f08d/abm-week-2021-quiz-bee
            $strand_abm = new StrandModel();
            $strand_abm->name = "Accountancy, Business and Management";
            $strand_abm->code = "ABM";
            $strand_abm->status = "Active";
            $strand_abm->about = "The ABM Strand is for those who plan to take up business-related courses in higher education or engage in business, entrepreneurship, and other business-related careers.The Accountancy, Business and Management (ABM) strand would focus on the basic concepts of financial management, business management, corporate operations, and all things that are accounted for. ABM can also lead you to careers on management and accounting which could be sales manager, human resources, marketing director, project officer, bookkeeper, accounting clerk, internal auditor, and a lot more.";
            $strand_abm->save();


            // abm question 1
                $abm_q1 = new QuestionModel();
                $abm_q1->question = "Who uses the business plan to assess whether the entrepreneur will be able to meet the debt and interest payments?";
                $abm_q1->answer = "Lender";
                $abm_q1->strand_id = $strand_abm->id;
                $abm_q1->save();

                $abm_q1_c = new AnswersModel();
                $abm_q1_c->choice1 = "Lender";
                $abm_q1_c->choice2 = "Investor";
                $abm_q1_c->choice3 = "Trade Creditor";
                $abm_q1_c->choice4 = "None of the options";
                $abm_q1_c->question_id = $abm_q1->id;
                $abm_q1_c->save();
            // abm question 1

            // abm question 2
                $abm_q2 = new QuestionModel();
                $abm_q2->question = "Which part of the business plan highlights the objectives and strategies developed in order to attract consumers and make the product known to the public?";
                $abm_q2->answer = "Marketing Plan";
                $abm_q2->strand_id = $strand_abm->id;
                $abm_q2->save();

                $abm_q2_c = new AnswersModel();
                $abm_q2_c->choice1 = "Management Plan";
                $abm_q2_c->choice2 = "Production Plan";
                $abm_q2_c->choice3 = "Marketing Plan";
                $abm_q2_c->choice4 = "Executive Summary";
                $abm_q2_c->question_id = $abm_q2->id;
                $abm_q2_c->save();
            // abm question 2

            // abm question 3
                $abm_q3 = new QuestionModel();
                $abm_q3->question = "This is a business simulation activity wherein the organizational chart is completed.";
                $abm_q3->answer = "Marketing Aspect";
                $abm_q3->strand_id = $strand_abm->id;
                $abm_q3->save();

                $abm_q3_c = new AnswersModel();
                $abm_q3_c->choice1 = "Financial Aspect";
                $abm_q3_c->choice2 = "Management Aspect";
                $abm_q3_c->choice3 = "Operational Aspect";
                $abm_q3_c->choice4 = "Marketing Aspect";
                $abm_q3_c->question_id = $abm_q3->id;
                $abm_q3_c->save();
            // abm question 3

            // abm question 4
                $abm_q4 = new QuestionModel();
                $abm_q4->question = "This is a type of discount where several discounts are applied to the same product.";
                $abm_q4->answer = "Discount Series";
                $abm_q4->strand_id = $strand_abm->id;
                $abm_q4->save();

                $abm_q4_c = new AnswersModel();
                $abm_q4_c->choice1 = "Trade Discount";
                $abm_q4_c->choice2 = "Discount Series";
                $abm_q4_c->choice3 = "Single Discount";
                $abm_q4_c->choice4 = "Discount Wave";
                $abm_q4_c->question_id = $abm_q4->id;
                $abm_q4_c->save();
            // abm question 4

            // abm question 5
                $abm_q5 = new QuestionModel();
                $abm_q5->question = "If a blue paper is equivalent to 2 wholes, how much blue paper would you need to have 6 wholes and a half?";
                $abm_q5->answer = "2 1/2 blue papers";
                $abm_q5->strand_id = $strand_abm->id;
                $abm_q5->save();

                $abm_q5_c = new AnswersModel();
                $abm_q5_c->choice1 = "4 blue papers";
                $abm_q5_c->choice2 = "1 3/4 blue papers";
                $abm_q5_c->choice3 = "3 1/4 blue papers";
                $abm_q5_c->choice4 = "2 1/2 blue papers";
                $abm_q5_c->question_id = $abm_q5->id;
                $abm_q5_c->save();
            // abm question 5

            // abm question 6
                $abm_q6 = new QuestionModel();
                $abm_q6->question = "This is a marketing mix that refers to the way in which products are being delivered or distributed to customers?";
                $abm_q6->answer = "product";
                $abm_q6->strand_id = $strand_abm->id;
                $abm_q6->save();

                $abm_q6_c = new AnswersModel();
                $abm_q6_c->choice1 = "product";
                $abm_q6_c->choice2 = "promotion";
                $abm_q6_c->choice3 = "psychographic";
                $abm_q6_c->choice4 = "demographic";
                $abm_q6_c->question_id = $abm_q6->id;
                $abm_q6_c->save();
            // abm question 6

            // abm question 7
                $abm_q7 = new QuestionModel();
                $abm_q7->question = "What step in the entrepreneurial process pertains to the detection of opportunities that could make money for the entrepreneur?";
                $abm_q7->answer = "discovery";
                $abm_q7->strand_id = $strand_abm->id;
                $abm_q7->save();

                $abm_q7_c = new AnswersModel();
                $abm_q7_c->choice1 = "implementation";
                $abm_q7_c->choice2 = "concept developent";
                $abm_q7_c->choice3 = "discovery";
                $abm_q7_c->choice4 = "reaping the returns";
                $abm_q7_c->question_id = $abm_q7->id;
                $abm_q7_c->save();
            // abm question 7

        // abm ============================================================================================================================

        // gas ============================================================================================================================
            $strand_gas = new StrandModel();
            $strand_gas->name = "General Academic Strand";
            $strand_gas->code = "GAS";
            $strand_gas->status = "Active";
            $strand_gas->about = "GAS is a Senior High School strand that takes on a generalist approach in preparing students for college. It covers various disciplines like Humanities, Social Sciences, Organization, and Management.";
            $strand_gas->save();

            // gas question 1
                $gas_q1 = new QuestionModel();
                $gas_q1->question = "Bees must collect nectar from approximately how many flowers to make 1 pound of honeycomb?";
                $gas_q1->answer = "20 million";
                $gas_q1->strand_id = $strand_gas->id;
                $gas_q1->save();

                $gas_q1_c = new AnswersModel();
                $gas_q1_c->choice1 = "10 thousand";
                $gas_q1_c->choice2 = "2 million";
                $gas_q1_c->choice3 = "20 million";
                $gas_q1_c->choice4 = "50 million";
                $gas_q1_c->question_id = $gas_q1->id;
                $gas_q1_c->save();
            // gas question 1

            // gas question 2
                $gas_q2 = new QuestionModel();
                $gas_q2->question = "Albacore is a type of:";
                $gas_q2->answer = "tuna";
                $gas_q2->strand_id = $strand_gas->id;
                $gas_q2->save();

                $gas_q2_c = new AnswersModel();
                $gas_q2_c->choice1 = "shell-fish";
                $gas_q2_c->choice2 = "tuna";
                $gas_q2_c->choice3 = "marble";
                $gas_q2_c->choice4 = "meteoroid";
                $gas_q2_c->question_id = $gas_q2->id;
                $gas_q2_c->save();
            // gas question 2

            // gas question 3
                $gas_q3 = new QuestionModel();
                $gas_q3->question = "The only species of cat that lives and hunts in groups is:";
                $gas_q3->answer = "lion";
                $gas_q3->strand_id = $strand_gas->id;
                $gas_q3->save();

                $gas_q3_c = new AnswersModel();
                $gas_q3_c->choice1 = "lion";
                $gas_q3_c->choice2 = "leopard";
                $gas_q3_c->choice3 = "jaguar";
                $gas_q3_c->choice4 = "reaping the returns";
                $gas_q3_c->question_id = $gas_q3->id;
                $gas_q3_c->save();
            // gas question 3

            // gas question 4
                $gas_q4 = new QuestionModel();
                $gas_q4->question = "Which prefix is often used with scientific terms to indicate that  something is the same, equal or constant?";
                $gas_q4->answer = "iso";
                $gas_q4->strand_id = $strand_gas->id;
                $gas_q4->save();

                $gas_q4_c = new AnswersModel();
                $gas_q4_c->choice1 = "iso";
                $gas_q4_c->choice2 = "mega";
                $gas_q4_c->choice3 = "meta";
                $gas_q4_c->choice4 = "quasi";
                $gas_q4_c->question_id = $gas_q4->id;
                $gas_q4_c->save();
            // gas question 4

            // gas question 5
                $gas_q5 = new QuestionModel();
                $gas_q5->question = "The study of phenomena at very low temperatures is called:";
                $gas_q5->answer = "cryogenics";
                $gas_q5->strand_id = $strand_gas->id;
                $gas_q5->save();

                $gas_q5_c = new AnswersModel();
                $gas_q5_c->choice1 = "heat transfer";
                $gas_q5_c->choice2 = "morphology";
                $gas_q5_c->choice3 = "crystallography";
                $gas_q5_c->choice4 = "cryogenics";
                $gas_q5_c->question_id = $gas_q5->id;
                $gas_q5_c->save();
            // gas question 5

            // gas question 6
                $gas_q6 = new QuestionModel();
                $gas_q6->question = "The branch of medical science which is concerned with the study of disease as it affects a community of people is called:";
                $gas_q6->answer = "epidemiology";
                $gas_q6->strand_id = $strand_gas->id;
                $gas_q6->save();

                $gas_q6_c = new AnswersModel();
                $gas_q6_c->choice1 = "epidemiology";
                $gas_q6_c->choice2 = "oncology";
                $gas_q6_c->choice3 = "paleontogy";
                $gas_q6_c->choice4 = "pathology";
                $gas_q6_c->question_id = $gas_q6->id;
                $gas_q6_c->save();
            // gas question 6

            // gas question 7
                $gas_q7 = new QuestionModel();
                $gas_q7->question = "The study of how people use tools to perform work and how people physically relate to their working environment is called: ";
                $gas_q7->answer = "ergonomics";
                $gas_q7->strand_id = $strand_gas->id;
                $gas_q7->save();

                $gas_q7_c = new AnswersModel();
                $gas_q7_c->choice1 = "engineering";
                $gas_q7_c->choice2 = "ergonomics";
                $gas_q7_c->choice3 = "agronomy";
                $gas_q7_c->choice4 = "physiology";
                $gas_q7_c->question_id = $gas_q7->id;
                $gas_q7_c->save();
            // gas question 7
        // gas ============================================================================================================================



        // humss ============================================================================================================================
            $strand_humss = new StrandModel();
            $strand_humss->name = "Humanities and Social Sciences";
            $strand_humss->code = "HUMSS";
            $strand_humss->status = "Active";
            $strand_humss->about = "The Humanities and Social Sciences (HUMSS) strands equip students with a wide range of discipline with the use of their experiences and skills into the investigation and inquiry of human situations by studying its behavior and social changes using empirical, analytical, and critical method techniques.";
            $strand_humss->save();

            // humss question 1
                $humss_q1 = new QuestionModel();
                $humss_q1->question = "In which country was a method for making rust-resistant iron discovered in the fifth century B.C.?";
                $humss_q1->answer = "India";
                $humss_q1->strand_id = $strand_humss->id;
                $humss_q1->save();

                $humss_q1_c = new AnswersModel();
                $humss_q1_c->choice1 = "Sumeria";
                $humss_q1_c->choice2 = "Egypt";
                $humss_q1_c->choice3 = "India";
                $humss_q1_c->choice4 = "Babylon";
                $humss_q1_c->question_id = $humss_q1->id;
                $humss_q1_c->save();
            // humss question 1

            // humss question 2
                $humss_q2 = new QuestionModel();
                $humss_q2->question = "At room temperature, most elements are in which phase of matter?";
                $humss_q2->answer = "solid";
                $humss_q2->strand_id = $strand_humss->id;
                $humss_q2->save();

                $humss_q2_c = new AnswersModel();
                $humss_q2_c->choice1 = "gas";
                $humss_q2_c->choice2 = "solid";
                $humss_q2_c->choice3 = "liquid";
                $humss_q2_c->choice4 = "plasma";
                $humss_q2_c->question_id = $humss_q2->id;
                $humss_q2_c->save();
            // humss question 2

            // humss question 3
                $humss_q3 = new QuestionModel();
                $humss_q3->question = "The per capita birth rate of a population is known as its:";
                $humss_q3->answer = "natality";
                $humss_q3->strand_id = $strand_humss->id;
                $humss_q3->save();

                $humss_q3_c = new AnswersModel();
                $humss_q3_c->choice1 = "mortality";
                $humss_q3_c->choice2 = "natality";
                $humss_q3_c->choice3 = "population density";
                $humss_q3_c->choice4 = "carrying capacity";
                $humss_q3_c->question_id = $humss_q3->id;
                $humss_q3_c->save();
            // humss question 3

            // humss question 4
                $humss_q4 = new QuestionModel();
                $humss_q4->question = "Who is called the Father of the Nuclear Navy?";
                $humss_q4->answer = "Hymen Rickover";
                $humss_q4->strand_id = $strand_humss->id;
                $humss_q4->save();

                $humss_q4_c = new AnswersModel();
                $humss_q4_c->choice1 = "Edward Teller";
                $humss_q4_c->choice2 = "Robert Oppenheimer";
                $humss_q4_c->choice3 = "Hymen Rickover";
                $humss_q4_c->choice4 = "Chester Nimitz";
                $humss_q4_c->question_id = $humss_q4->id;
                $humss_q4_c->save();
            // humss question 4

            // humss question 5
                $humss_q5 = new QuestionModel();
                $humss_q5->question = "The science of weights and measures is called:";
                $humss_q5->answer = "metrology";
                $humss_q5->strand_id = $strand_humss->id;
                $humss_q5->save();

                $humss_q5_c = new AnswersModel();
                $humss_q5_c->choice1 = "metrology";
                $humss_q5_c->choice2 = "meteorology";
                $humss_q5_c->choice3 = "mineralogy";
                $humss_q5_c->choice4 = "morphology";
                $humss_q5_c->question_id = $humss_q5->id;
                $humss_q5_c->save();
            // humss question 5

            // humss question 6
                $humss_q6 = new QuestionModel();
                $humss_q6->question = "Which of the following is primarily composed of calcium carbonate?";
                $humss_q6->answer = "Oyster Shells";
                $humss_q6->strand_id = $strand_humss->id;
                $humss_q6->save();

                $humss_q6_c = new AnswersModel();
                $humss_q6_c->choice1 = "Fish scales";
                $humss_q6_c->choice2 = "Shark teeth";
                $humss_q6_c->choice3 = "Oyster Shells";
                $humss_q6_c->choice4 = "Whale bones";
                $humss_q6_c->question_id = $humss_q6->id;
                $humss_q6_c->save();
            // humss question 6

            // humss question 7
                $humss_q7 = new QuestionModel();
                $humss_q7->question = "What radioactive element is routinely used in treating hyperthyroidism, and in reducing thyroid activity?";
                $humss_q7->answer = "Iodine-131";
                $humss_q7->strand_id = $strand_humss->id;
                $humss_q7->save();

                $humss_q7_c = new AnswersModel();
                $humss_q7_c->choice1 = "Iron-59";
                $humss_q7_c->choice2 = "Gold-198";
                $humss_q7_c->choice3 = "Cobalt-60";
                $humss_q7_c->choice4 = "Iodine-131";
                $humss_q7_c->question_id = $humss_q7->id;
                $humss_q7_c->save();
            // humss question 7


            return "saved";

    }

    function loadAssessmentProcesspage()
    {
        if(!session()->exists('assessment_status'))
        {
            session()->put('assessment_status', 1);
        }
        $student_id = session()->get('student_id');

        // get the unanswered exam questions of the student
        $questions = $this->getUnansweredStudentExam($student_id);

        // get the current progress
        $progress = $this->calculatePercentProgress($student_id);

        // get the total number of questions & already answered questions
        $count_done_answered = count($this->getAnsweredQuestion($student_id));
        $total_no_questions = count($this->getStudentExamQuestions($student_id));

        return view('pages.student.assessment2', compact('student_id', 'questions', 'progress', 'total_no_questions', 'count_done_answered'));
    }

    function updateProgress(Request $r)
    {
        $current_question = $r->question_id;
        $student_id = session()->get('student_id');

        //get all the exam questions
        // not useful code
        $questions = $this->getAnsweredQuestion($student_id);

        //update the student exam questions
        $this->update_student_exam($student_id, $current_question);
        
        //calculate percentage progress
        $progress = $this->calculatePercentProgress($student_id);

        // get the total number of questions & already answered questions
        $count_done_answered = count($this->getAnsweredQuestion($student_id));
        $total_no_questions = count($this->getStudentExamQuestions($student_id));
        
        return response()->json([
            'status' => true,
            'message' => 'updated',
            'progress' => $progress,
            'total_questions' => $total_no_questions,
            'answered' => $count_done_answered
        ]);
    }

    function calculatePercentProgress($student_id)
    {
        /*
            formula: P = (X/Y) * 100

            where: 
                P - is the percentage
                X - is the number to be convverted to percentage
                Y - is the total number
        */
        $count_done_answered = count($this->getAnsweredQuestion($student_id));
        $total_no_questions = count($this->getStudentExamQuestions($student_id));

        //get progress in percent format
        $progress = ($count_done_answered/$total_no_questions) * 100;

        return $progress;
    }

    function loadPreAssessmentpage(Request $r)
    {
        $student_id = session()->get('student_id');
        
        return view('pages.student.pre_assessment', compact('student_id'));
    }

    // function getStudentExamQuestions($student_id, $s_code)
    // {
    //     $strand_questions = StudentModel::join('tblstudent_exam', 'tblstudent.student_id', '=', 'tblstudent_exam.student_id')
    //                                    ->join('tblquestion', 'tblstudent_exam.question_id', '=', 'tblquestion.question_id')
    //                                    ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
    //                                    ->join('tblstrand', 'tblquestion.strand_id', '=', 'tblstrand.strand_id')
    //                                    ->where('tblstrand.code', '=', $s_code)
    //                                    ->where('tblstudent.student_id', '=', $student_id)
    //                                    ->get();
    //     return $strand_questions;
    // }
    
    // for process purposes
    function getStudentExamQuestions($student_id, $s_code = "")
    {
        if($s_code == "")
        {
            $questions = StudentModel::join('tblstudent_exam', 'tblstudent.student_id', '=', 'tblstudent_exam.student_id')
                                       ->join('tblquestion', 'tblstudent_exam.question_id', '=', 'tblquestion.question_id')
                                       ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                       ->join('tblstrand', 'tblquestion.strand_id', '=', 'tblstrand.strand_id')
                                       ->where('tblstudent.student_id', '=', $student_id)
                                       ->get();
            return $questions;
        }
        else
        {
            $questions = StudentModel::join('tblstudent_exam', 'tblstudent.student_id', '=', 'tblstudent_exam.student_id')
                                       ->join('tblquestion', 'tblstudent_exam.question_id', '=', 'tblquestion.question_id')
                                       ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                       ->join('tblstrand', 'tblquestion.strand_id', '=', 'tblstrand.strand_id')
                                       ->where('tblstrand.code', '=', $s_code)
                                       ->where('tblstudent.student_id', '=', $student_id)
                                       ->get();
            return $questions;
        }
    }

    // for viewing purposes
    function getUnansweredStudentExam($student_id)
    {
        $questions = StudentModel::join('tblstudent_exam', 'tblstudent.student_id', '=', 'tblstudent_exam.student_id')
                                       ->join('tblquestion', 'tblstudent_exam.question_id', '=', 'tblquestion.question_id')
                                       ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                       ->join('tblstrand', 'tblquestion.strand_id', '=', 'tblstrand.strand_id')
                                       ->where('tblstudent.student_id', '=', $student_id)
                                       ->where('tblstudent_exam.is_answered', '=', 0)
                                       ->get();
        return $questions;
    }

    //for updating while taking the exam
    function getAnsweredQuestion($student_id)
    {
        $questions = StudentModel::join('tblstudent_exam', 'tblstudent.student_id', '=', 'tblstudent_exam.student_id')
                                       ->join('tblquestion', 'tblstudent_exam.question_id', '=', 'tblquestion.question_id')
                                       ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
                                       ->join('tblstrand', 'tblquestion.strand_id', '=', 'tblstrand.strand_id')
                                       ->where('tblstudent.student_id', '=', $student_id)
                                       ->where('tblstudent_exam.is_answered', '=', 1)
                                       ->get();
        return $questions;
    }   

    // function getStudentExamQuestions($student_id, $s_code)
    // {
    //     $strand_questions = StudentModel::join('tblstudent_exam', 'tblstudent.student_id', '=', 'tblstudent_exam.student_id')
    //                                    ->join('tblquestion', 'tblstudent_exam.question_id', '=', 'tblquestion.question_id')
    //                                    ->join('tblanswers', 'tblquestion.question_id', '=', 'tblanswers.question_id')
    //                                    ->join('tblstrand', 'tblquestion.strand_id', '=', 'tblstrand.strand_id')
    //                                    ->where('tblstrand.code', '=', $s_code)
    //                                    ->where('tblstudent.student_id', '=', $student_id)
    //                                    ->get();
    //     return $strand_questions;
    // }

    // function loadAssessmentpage(Request $r)
    // {
    //     if(!session()->exists('assessment_status'))
    //     {
    //         session()->put('assessment_status', 1);
    //     }

    //     // get the student assessment questions
    //     $student_id = session()->get('student_id');

    //     // stem questions
    //     $stem_questions = $this->getStudentExamQuestions($student_id, "STEM");
    //     // gas questions
    //     $gas_questions = $this->getStudentExamQuestions($student_id, "GAS");
    //     // abm questions
    //     $abm_questions = $this->getStudentExamQuestions($student_id, "ABM");
    //     // humss questions
    //     $humss_questions = $this->getStudentExamQuestions($student_id, "HUMSS");

    //     return view('pages.student.assessment', compact('stem_questions', 'gas_questions', 'abm_questions', 'humss_questions', 'student_id'));
    // }

    // function loadAssessmentPage_stem()
    // {
    //     // get the student assessment questions
    //     $student_id = session()->get('student_id');

    //     // stem questions
    //     $stem_questions = $this->getStudentExamQuestions($student_id, "STEM");

    //     return view('pages.student.assessment_stem', compact('stem_questions', 'student_id'));
    // }

    // function loadAssessmentPage_gas()
    // {
    //     // get the student assessment questions
    //     $student_id = session()->get('student_id');

    //     // gas questions
    //     $gas_questions = $this->getStudentExamQuestions($student_id, "GAS");

    //     return view('pages.student.assessment_gas', compact('gas_questions', 'student_id'));
    // }

    // function loadAssessmentPage_abm()
    // {
    //     // get the student assessment questions
    //     $student_id = session()->get('student_id');

    //     // abm questions
    //     $abm_questions = $this->getStudentExamQuestions($student_id, "ABM");

    //     return view('pages.student.assessment_abm', compact('abm_questions', 'student_id'));
    // }

    // function loadAssessmentPage_humss()
    // {
    //     // get the student assessment questions
    //     $student_id = session()->get('student_id');


    //     // humss questions
    //     $humss_questions = $this->getStudentExamQuestions($student_id, "HUMSS");

    //     return view('pages.student.assessment_humss', compact('humss_questions', 'student_id'));
    // }

    function update_student_exam($student_id, $question_id)
    {
        $student_exam_q = Student_ExamModel::where("student_id", "=", $student_id)
                                         ->where("question_id", "=", $question_id);
        $update_student_exam_q = $student_exam_q->update(
            [
                'is_answered' => 1
            ]
        );

        return;
    }

    function check_answers(Request $r)
    {
        // //checking of answers version 1
        // //initializations
        // $score = 0;

        // // student answer
        // $answers = $r->answers;

        // // fetch stem exam with correct answer
        // $student_id = $r->student_id;
        // $s_code = $r->s_code;
        // $stem_student_exam = $this->getStudentExamQuestions($student_id, $s_code);

        // // loop the student answer
        // for($i = 0;$i<count($answers);$i++)
        // {
        //     $question_id = $answers[$i]["question_id"];
        //     $student_answer = $answers[$i]["student_answer"];
            
        //     $q_details = QuestionModel::where("question_id", "=", $question_id)->first();
            
        //     if($student_answer == $q_details->answer)
        //     {
        //         // if correct
        //         $score++;
        //     }

        //     // update student exam
        //     $this->update_student_exam($student_id, $question_id);
        // }


        // // update table exam details

        // $student_exam_d = Student_Exam_DetailsModel::where('tblstudent_exam_details.student_id','=', $student_id);
        
        // $update_student_exam_d = $student_exam_d->update(
        //     [
        //         strtolower($s_code).'_score' => $score
        //     ]
        // );

        // if($update_student_exam_d)
        // {
        //     return response()->json([
        //         'status' => true,
        //         'message' => 'checked',
        //         'answers' => $answers,
        //         'score' => $score."/".count($answers)
        //     ]);
        // }







        //checking of answer version 2
        //initializations
        // student answer
        $answers = $r->answers;
        $student_id = $r->student_id;

        //separate the student answer according to strand
        //$sa means, student_answer
        $stem_answers = array();
        $abm_answers = array();
        $gas_answers = array();
        $humss_answers = array();
        
        for($sa=0;$sa<count($answers);$sa++)
        {
            if($answers[$sa]["strand_code"] == "STEM")
            {
                array_push($stem_answers, $answers[$sa]);
            }
            else if($answers[$sa]["strand_code"] == "GAS")
            {
                array_push($gas_answers, $answers[$sa]);
            }
            else if($answers[$sa]["strand_code"] == "HUMSS")
            {
                array_push($humss_answers, $answers[$sa]);
            }
            else if($answers[$sa]["strand_code"] == "ABM")
            {
                array_push($abm_answers, $answers[$sa]);
            }
        }

        //$stem_student_exam = $this->getStudentExamQuestions($student_id, $s_code);
        //check the separated answers by strand
        $check_stem = $this->check_by_strand($stem_answers, "stem", $student_id);
        $check_gas = $this->check_by_strand($gas_answers, "gas", $student_id);
        $check_humss = $this->check_by_strand($humss_answers, "humss", $student_id);
        $check_abm = $this->check_by_strand($abm_answers, "abm", $student_id);
        

        return response()->json([
            'status' => true,
            'message' => 'checked'
        ]);
    }

    function check_by_strand($answers, $s_code, $student_id)
    {
        $score = 0;
        // loop the student answer
        for($i = 0;$i<count($answers);$i++)
        {
            $question_id = $answers[$i]["question_id"];
            $student_answer = $answers[$i]["student_answer"];
            
            $q_details = QuestionModel::where("question_id", "=", $question_id)->first();
            
            if($student_answer == $q_details->answer)
            {
                // if correct
                $score++;
            }

            // update student exam
            $this->update_student_exam($student_id, $question_id);
        }


        // update table exam details

        $student_exam_d = Student_Exam_DetailsModel::where('student_id','=', $student_id);
        
        $update_student_exam_d = $student_exam_d->update(
            [
                $s_code.'_score' => $score
            ]
        );

        if($update_student_exam_d == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function rank_strand_scores(Request $r)
    {
        
        $student_id = $r->student_id;

        $student_exam_d = Student_Exam_DetailsModel::join('tblstudent', 'tblstudent_exam_details.student_id', '=', 'tblstudent.student_id')
                                                   ->where('tblstudent_exam_details.student_id','=', $student_id)
                                                   ->first();


        // get the overall scores
        $stem_totalQ  = $this->getStudentExamQuestions($student_id, 'STEM')->count();
        $humss_totalQ  = $this->getStudentExamQuestions($student_id, 'HUMSS')->count();
        $gas_totalQ  = $this->getStudentExamQuestions($student_id, 'GAS')->count();
        $abm_totalQ  = $this->getStudentExamQuestions($student_id, 'ABM')->count();
        
        $stem = (int) $student_exam_d->stem_score;
        $humss = (int) $student_exam_d->humss_score;
        $gas = (int) $student_exam_d->gas_score;
        $abm = (int) $student_exam_d->abm_score;

        $scores = array();
        array_push($scores, $stem);
        array_push($scores, $humss);
        array_push($scores, $gas);
        array_push($scores, $abm);

        rsort($scores);

        //session()->put('ranked_scores', $scores);

        return response()->json([
            'status' => true,
            'message' => 'ranked',
            'student_data' => $scores,
            'details' => $student_exam_d,
            'stem_totalQ' => $stem_totalQ,
            'humss_totalQ' => $humss_totalQ,
            'gas_totalQ' => $gas_totalQ,
            'abm_totalQ' => $abm_totalQ
        ]);

    }

    // function check_internet($site = "https://youtube.com/")
    // {
    //     if(@fopen($site, "r"))
    //     {
    //         return true;
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }

    function loadAssessmentFeedbackpage()
    {
        return view('pages.student.feedback');
    }

    function loadFeedbackEmailTemplate()
    {
        return view('pages.student.feedback_email_template');
    }

    function exitAssessment()
    {
        session()->pull('student_id');
        session()->pull('assessment_status');

        return response()->json([
            'status' => true,
            'message' => 'exit'
        ]);
    }
}
