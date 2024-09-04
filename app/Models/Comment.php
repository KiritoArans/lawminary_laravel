<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'tblcomments';

    protected $fillable = [
        'comment', 
        'user_id', 
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'post_id'); // Ensure it uses the correct key
    }

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }
    
}

