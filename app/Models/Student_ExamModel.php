<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_ExamModel extends Model
{
    use HasFactory;

    protected $table = 'tblstudent_exam';

    protected $fillable = [
        'student_id',
        'question_id',
        'student_exam_details_id',
    ];

    public function student()
    {
        return $this->belongsTo(StudentModel::class);
    }

    public function questions()
    {
        return $this->hasMany(QuestionModel::class);
    }

    public function exam_details()
    {
        return $this->belongsTo(Student_Exam_DetailsModel::class);
    }
}
