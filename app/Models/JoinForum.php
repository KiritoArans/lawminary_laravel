<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinForum extends Model
{
    use HasFactory;

    protected $table = 'tblforummembers';

    protected $fillable = [
        'user_id',
        'forum_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }
    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id', 'forum_id');
    }
}