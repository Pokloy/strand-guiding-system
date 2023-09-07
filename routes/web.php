<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\signInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\StrandController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;


use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//default route
// Route::get('/', function () {
//     return view('welcome');
// });

// dummy routes
// Route::get('/addUser', function () {
//     $user = new UserModel();
//     $user->fname = "Apao";
//     $user->email = "dawda";
//     $user->password = "adwad";
//     $user->save();
// })->name('addUser');

// templates and dummy routes
Route::get('/feedbackemail-template', [AssessmentController::class, 'loadFeedbackEmailTemplate'])->name('strand.load_feedbackemailTemplate');
Route::get('/verificationemail-template', [RegistrationController::class, 'loadVerificationEmailTemplate'])->name('strand.load_verificationemailTemplate');
Route::get('/template', [StrandController::class, 'loadTemplate'])->name('strand.load');
Route::get('/addQ_Strands', [AssessmentController::class, 'createdummyQuestions_Strands'])->name('dummy.strand.create');

Route::get('/', [IndexController::class, 'loadIndex'])->name('n_loadIndex');

Route::group(['middleware' => ['checkSignIn']], function(){

    Route::get('/signIn', [signInController::class, 'loadSignInpage'])->name('signin');

    Route::get('/users', [UserController::class, 'loaduserspage'])->name('users.load');
    Route::get('/account-settings', [UserController::class, 'loadAccountSettings'])->name('account.settings.load');
    Route::get('/security-settings', [UserController::class, 'loadSecuritySettings'])->name('security.settings.load');
    
    Route::get('/strands', [StrandController::class, 'loadStrand'])->name('strand.load');
    Route::get('/view-strand/{strand_id}', [StrandController::class, 'loadviewStrand'])->name('viewstrand.load');
});


Route::group(['middleware' => ['checkRegistration']], function(){
    
    Route::get('/registration', [RegistrationController::class, 'loadRegistrationpage'])->name('registration');
    Route::get('/verification', [RegistrationController::class, 'verifyEmail'])->name('email.verify');
    
    Route::get('/preassessment', [AssessmentController::class, 'loadPreAssessmentpage'])->name('preassessment');
    Route::get('/assessment', [AssessmentController::class, 'loadAssessmentpage'])->name('assessment');
    Route::get('/assessment/stem', [AssessmentController::class, 'loadAssessmentPage_stem'])->name('assessment.stem');
    Route::get('/assessment/gas', [AssessmentController::class, 'loadAssessmentPage_gas'])->name('assessment.gas');
    Route::get('/assessment/humss', [AssessmentController::class, 'loadAssessmentPage_humss'])->name('assessment.humss');
    Route::get('/assessment/abm', [AssessmentController::class, 'loadAssessmentPage_abm'])->name('assessment.abm');
    //Route::get('/begin-assessment', [AssessmentController::class, 'loadAssessmentpage'])->name('begin.assessment');
    Route::get('/feedback-assessment', [AssessmentController::class, 'loadAssessmentFeedbackpage'])->name('feedback.assessment');
    Route::get('/assessment-process', [AssessmentController::class, 'loadAssessmentProcesspage'])->name('process.assessment');

});

Route::get('/signup', [SignUpController::class, 'loadSignUpPage'])->name('signup');
Route::get('home', [HomeController::class, 'loadHome'])->name('home.load');

// functions
Route::post('/add-strand', [StrandController::class, 'addStrand'])->name('strand.add');
Route::post('/fetch-strand', [StrandController::class, 'fetchStrand'])->name('strand.fetch');
Route::post('/update-strand', [StrandController::class, 'updateStrand'])->name('strand.update');
Route::post('/search-strand', [StrandController::class, 'searchStrand'])->name('strand.search');
Route::post('/count-strands', [StrandController::class, 'countStrands'])->name('strand.count');

Route::post('/view-questions', [QuestionController::class, 'viewQuestions'])->name('view.questions');
Route::post('/add-question', [QuestionController::class, 'addQuestion'])->name('add.question');
Route::post('/fetch-question', [QuestionController::class, 'fetchQuestion'])->name('fetch.question');
Route::post('/update-question', [QuestionController::class, 'updateQuestion'])->name('update.question');
Route::post('/delete-question', [QuestionController::class, 'deleteQuestion'])->name('delete.question');
Route::post('/get-q-answers', [QuestionController::class, 'getQ_answers'])->name('get.Q_answers');

Route::post('/rank_scores', [AssessmentController::class, 'rank_strand_scores'])->name('rank.scores');
Route::post('/check_student_answers', [AssessmentController::class, 'check_answers'])->name('assessment.check_answers');
Route::post('/exit-assessment', [AssessmentController::class, 'exitAssessment'])->name('assessment.exit');
Route::post('/update-assessmentProgress', [AssessmentController::class, 'updateProgress'])->name('assessment.updateProgress');

Route::post('/register', [RegistrationController::class, 'register'])->name('student.register');
Route::post('/unregister', [RegistrationController::class, 'unregister'])->name('student.unregister');
Route::post('/fetch-verification_details', [RegistrationController::class, 'fetchVerificationDetails'])->name('fetch.verification.details');
Route::post('/update-verification_details', [RegistrationController::class, 'updateVerificationDetails'])->name('update.verification.details');
Route::post('/verify-registration', [RegistrationController::class, 'verifyRegistration'])->name('registration.verify');
Route::post('/validate_resendVerif', [RegistrationController::class, 'resendVerification_validate'])->name('resendVerif.validate');

Route::get('/add-users-dummy', [UserController::class, 'addDummyUser'])->name('user.add.dummy');
Route::post('/update-security-account', [UserController::class, 'setupSecurity'])->name('security.settings.update');
Route::get('/forgot-password', [UserController::class, 'loadForgotPassword'])->name('forgot.password.load');

Route::post('/get-last-user_id', [UserController::class, 'getLast_UserId'])->name('get.last_userid');
Route::post('/add-users', [UserController::class, 'addUser'])->name('user.add');
Route::post('/fetch-user', [UserController::class, 'fetchUser'])->name('user.fetch');
Route::post('/update-user', [UserController::class, 'updateUser'])->name('user.update');
Route::post('/update-account', [UserController::class, 'updateAccount'])->name('user.update.account');
Route::post('/verify-user-fp', [UserController::class, 'validateUsernameForgotPass'])->name('username.verify.forgotPass');
Route::post('/verify-security-qa', [UserController::class, 'verifySecurityQA'])->name('securityQA.verify.forgotPass');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password.forgotPass');

Route::post('/signInUser', [signInController::class, 'signInUser'])->name('signin_user');
Route::post('/registerAdmin', [signInController::class, 'adminRegister'])->name('register_admin');
Route::post('/logout', [signInController::class, 'logout'])->name('logout_user');
Route::post('/remove_register_session', [signInController::class, 'removeRegister_session'])->name('registerSession.remove');