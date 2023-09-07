<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationModel extends Model
{
    use HasFactory;

    protected $table = 'tblverification';

    protected $fillable = [
        'verification_id',
        'verification_code',
        'is_verified'
    ];

    public function student()
    {
        return $this->belongsTo(Student_Model::class);
    }
}
