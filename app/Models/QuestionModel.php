<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    use HasFactory;

    protected $table = 'tblquestion';

    protected $fillable = [
        'question',
        'answer',
        'strand_id'
    ];

    public function strand()
    {
        return $this->belongsTo(StrandModel::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswersModel::class);
    }
}
