<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'tblusers';

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'uname',
        'pass',
        'utype',
        'status',
        'sec_ques',
        'sec_answer'
    ];
}
