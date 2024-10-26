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
        'userPhoto',
        'username',
        'email',
        'password',
        'firstName',
        'middleName',
        'lastName',
        'birthDate',
        'sex',
        'accountType',
        'lawyerID',
        'fieldExpertise',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Carbon::now()->format('YmdHis');

            // $model->accountType = $model->accountType ?? 'User';
        });
    }

    public static function findByUserId($userId)
    {
        return self::where('user_id', $userId)->first();
    }

    public function posts()
    {
        return $this->hasMany(Posts::class, 'postedBy', 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'user_id', 'user_id');
    }

    public function reply()
    {
        return $this->hasMany(Reply::class, 'user_id', 'user_id');
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'following', 'user_id');
    }

    public function liker()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id');
    }

    public function bookmarker()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id');
    }

    public function commenter()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id');
    }

    public function replier()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id');
    }

    public function rater()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id');
    }
    public function follower()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id');
    }
    public function leaduser()
    {
        return $this->hasMany(UserAccount::class, 'lawyerUser_id', 'user_id');
    }
    public function restrictedUser()
    {
        return $this->hasOne(Restrict::class, 'user_id', 'user_id');
    }
}
