<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'tbldashboard';

    protected $fillable = [
        'pending_post',
        'pending_accounts',
        'accounts',
        'act_id',
        'act_username',
        'act_action',
        'act_date',
        'created_at',
        'updated_at',
    ];
}
