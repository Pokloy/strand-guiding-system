<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswersModel extends Model
{
    use HasFactory;

    protected $table = 'tblanswers';

    protected $fillable = [
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'question_id'
    ];

    public function question()
    {
        return $this->belongsTo(QuestionModel::class);
    }
}
