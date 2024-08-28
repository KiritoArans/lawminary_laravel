<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'tblaccounts';

    protected $fillable = [
        'user_id',
        'username',
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'nationality',
        'sex',
        'contact_number',
        'account_type',
        'date_created'
    ];
}
