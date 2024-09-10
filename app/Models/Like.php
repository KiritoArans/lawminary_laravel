<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'tbllikes';

    protected $fillable = [
        'user_id', 
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }
}
