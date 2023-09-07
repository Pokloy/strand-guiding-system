<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'add-strand',
        'fetch-strand',
        'update-strand',
        'view-questions',
        'add-question',
        'fetch-question',
        'update-question',
        'delete-question',
        'get-q-answers',
        'unregister',
        'check_student_answers',
        'rank_scores',
        'exit-assessment',
        'search-strand',
        'fetch-verification_details',
        'update-verification_details',
        'verify-registration',
        'update-assessmentProgress',
        'validate_resendVerif',
        'add-users',
        'fetch-user',
        'update-user',
        'get-last-user_id',
        'update-account',
        'count-strands',
        'update-security-account',
        'verify-user-fp',
        'verify-security-qa',
        'reset-password',
        'test'
    ];
}
