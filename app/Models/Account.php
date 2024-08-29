<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Account extends Model
{
    use HasFactory;

    protected $table = 'tblaccounts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'username', 'email', 'password', 'firstName', 'middleName', 
        'lastName', 'birthDate', 'nationality', 'sex', 'contactNumber', 
        'restrict', 'restrictDays', 'account_type'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Carbon::now()->format('YmdHis');
        });
    }
}

