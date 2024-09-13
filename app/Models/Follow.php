<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $table = 'tblfollowings';

    protected $fillable = [
        'follower', 
        'following',
    ];

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'follower', 'user_id');
    }
    public function followedUser()
    {
        return $this->belongsTo(UserAccount::class, 'following', 'user_id');
    }

    public function followerUser()
    {
        return $this->belongsTo(UserAccount::class, 'follower', 'user_id');
    }

}
