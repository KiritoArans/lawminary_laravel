<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restrict extends Model
{
    use HasFactory;

    protected $table = 'tblrestrict';
    protected $fillable = ['user_id', 'restrict_days'];

    // Define the relationship with UserAccount
    public function restrictedUser()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }
}
