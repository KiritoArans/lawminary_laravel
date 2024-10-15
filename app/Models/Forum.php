<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'tblforums';

    protected $fillable = ['forum_id', 'forumName', 'forumPhoto', 'forumDesc'];

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id'); // Assuming 'post_id' is the key used in both tables
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'post_id', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'postedBy', 'user_id');
    }
    public function reply()
    {
        return $this->hasMany(Reply::class, 'comment_id', 'comment_id');
    }
}
