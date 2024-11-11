<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedAccount extends Model
{
    use HasFactory;

    protected $table = 'tbl_banned';

    protected $fillable = ['user_id', 'restriction_count', 'blocked_at'];

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }
}
