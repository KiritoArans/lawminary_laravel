<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbldashboard', function (Blueprint $table) {
            $table->id();
            $table->integer('pending_posts')->default(0);
            $table->integer('pending_accounts')->default(0);
            $table->string('accounts')->default('');
            $table->string('act_id');
            $table->string('act_username');
            $table->string('act_action');
            $table->string('act_date');
            $table->timestamps();
    });
    }

    //dashboard get table
    public function index()
    {
        // Fetch data from the `tbldashboard` table
        $data = ModelModerator::all();

        // Pass the data to the view
        return view('dashboard.index', compact('data'));
    }
};
