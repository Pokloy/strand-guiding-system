<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Exam_DetailsModel extends Model
{
    use HasFactory;

    protected $table = 'tblstudent_exam_details';

    protected $fillable = [
        'student_id',
        'stem_score',
        'humss_score',
        'gas_score',
        'abm_score',
    ];

    public function student()
    {
        return $this->belongsTo(StudentModel::class);
    }

    public function exam()
    {
        return $this->hasMany(Student_ExamModel::class);
    }
}
