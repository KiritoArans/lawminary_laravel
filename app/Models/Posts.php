<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'tblposts';

    protected $fillable = [
        'post_id', 
        'concern', 
        'postedBy', 
        'approvedBy',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id'); // Assuming 'post_id' is the key used in both tables
    }
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'postedBy', 'user_id');
    }
}
