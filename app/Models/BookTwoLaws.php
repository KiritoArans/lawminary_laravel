<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookTwoLaws extends Model
{
    protected $table = 'tblbooktwo';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'title_name',
        'chapter_number',
        'chapter_name',
        'section',
        'section_name',
        'article_no',
        'article_name',
        'description',
        'synonyms',
    ];
}
