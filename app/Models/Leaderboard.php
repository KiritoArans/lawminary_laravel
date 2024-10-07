<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $table = 'tblleaderboards'; // Specify the table name

    protected $fillable = ['lawyerUser_id', 'rankPoints', 'rank', 'position'];

    // Define any relationships if needed, for example, to Points
    public function points()
    {
        return $this->hasMany(Point::class, 'lawyerUser_id', 'lawyerUser_id');
    }
}
