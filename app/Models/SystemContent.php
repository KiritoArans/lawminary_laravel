<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemContent extends Model
{
    protected $table = 'tblsyscon';

    protected $fillable = ['name', 'content', 'created_at', 'updated_at'];
}
