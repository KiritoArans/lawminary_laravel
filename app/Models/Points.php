<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;

    protected $table = 'tblpoints';

    protected $fillable = [
        'lawyerUser_id', 
        'points',
        'pointsFrom',
    ];

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'lawyerUser_id', 'user_id');
    }
}