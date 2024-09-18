<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemContent extends Model
{
    protected $table = 'tblsyscon';

    protected $fillable = [
        'system_name',
        'about_lawminray',
        'about_pao',
        'terms_of_service',
        'logo_path',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
