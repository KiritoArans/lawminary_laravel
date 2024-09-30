<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    // Define the table associated with this model (if different from the default 'otps')
    protected $table = 'otps';

    // Define the fields that are mass assignable
    protected $fillable = [
        'user_id',     // The user the OTP is for
        'otp',         // The OTP code
        'expires_at',  // The expiration time of the OTP
        'purpose', 
    ];

    // Indicate the data types for the attributes
    protected $casts = [
        'expires_at' => 'datetime', // Cast 'expires_at' as a datetime object
    ];

    // Define the relationship with the UserAccount model
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id'); // Link to UserAccount with user_id
    }
}
