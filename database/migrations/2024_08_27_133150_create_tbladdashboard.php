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
        Schema::create('tbladdashboard', function (Blueprint $table) {
            $table->id();
            $table->int('pending post');
            $table->int('pending accounts');
            $table->int('accounts');
            $table->int('act_id');
            $table->varchar('act_user');
            $table->varchar('act_action');
            $table->varchar('act_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbladdashboard');
    }
};
