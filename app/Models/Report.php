<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'tblreports'; // Explicitly specify the table name

    // Specify which columns can be mass assigned
    protected $fillable = [
        'report_id',
        'post_id',
        'user_id',
        'reportContent',
    ];

    // You can add relationships to the `Post` and `User` models if needed
    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }
}
