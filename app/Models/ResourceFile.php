<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceFile extends Model
{
    use HasFactory;

    protected $table = 'tblresources';

    protected $fillable = ['documentTitle', 'documentDesc', 'documentFile'];
}
