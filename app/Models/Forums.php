<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forums extends Model
{
    protected $table = 'tblforums';

    protected $fillable = [
        'forum_name',
        'forum_desc',
        'mem_count',
        'created_at',
        'updated_at',
    ];
}
