<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'tblforums';

    protected $fillable = [
        'forum_id',
        'forumName',
        'forumDesc',
    ];
}
