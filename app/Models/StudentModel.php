<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;

    protected $table = 'tblstudent';

    protected $fillable = [
        'firstname',
        'lastnamea',
        'email'
    ];

    public function exam()
    {
        return $this->hasOne(Student_ExamModel::class);
    }

    public function exam_details()
    {
        return $this->hasOne(Student_Exam_DetailsModel::class);
    }

    public function verification()
    {
        return $this->hasOne(VerificationModel::class);
    }
    
}
