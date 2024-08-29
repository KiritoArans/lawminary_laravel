<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'tblaccounts';  // Ensure this matches your table name
    
    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';  // Adjust this if necessary

    // Set $incrementing to false if the primary key is not auto-incrementing
    public $incrementing = true;

    // Set the key type if the primary key is not an integer
    protected $keyType = 'int';

    // Add fillable fields to enable mass assignment
    protected $fillable = [
        'user_id', 'username', 'email', 'password', 'firstName', 'middleName', 
        'lastName', 'birthDate', 'nationality', 'sex', 'contactNumber', 
        'restrict', 'restrictDays', 'date_created', 'account_type'
    ];

    // Disable timestamps if your table doesn't have 'created_at' and 'updated_at'
    public $timestamps = true;  // Set to false if you don't have these columns
}
