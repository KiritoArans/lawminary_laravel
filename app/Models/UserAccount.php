<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tblaccounts';

    protected $fillable = [
        'username',
        'email',
        'password',
        'firstName',
        'middleName',
        'lastName',
        'birthDate',
        'nationality',
        'sex',
        'contactNumber',
        'accountType',
        'restrict',
        'restrictDays',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Carbon::now()->format('YmdHis');

            $model->accountType = $model->accountType ?? 'User';
        });
    }

    // public function likedPosts()
    // {
    //     return $this->belongsTo(Posts::class, 'postedBy', 'user_id');
    // }
}
