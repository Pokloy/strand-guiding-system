<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrandModel extends Model
{
    use HasFactory;

    protected $table = 'tblstrand';
    
    protected $fillable = [
        'name',
        'code',
        'status',
        'about'
    ];

    public function question()
    {
        return $this->hasMany(QuestionModel::class);
    }
}
