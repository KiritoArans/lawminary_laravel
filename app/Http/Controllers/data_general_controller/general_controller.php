<?php

namespace App\Http\Controllers\data_general_controller;

use App\Models\general_database;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class general_controller extends Controller
{
    public function showDashboard()
    {
        $dashboardData = (new general_database)->setTableName('dashboard')->get();
        return view('admin.dashboard', compact('dashboardData'));
    }

    public function showForums()
    {
        $forumsData = (new general_database)->setTableName('forums')->get();
        return view('admin.forums', compact('forumsData'));
    }
}
  
