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
            $table->string('pending_posts');
            $table->string('pending_accounts');
            $table->string('accounts');
            $table->string('act_id');
            $table->string('act_usernme');
            $table->string('act_action');
            $table->string('act_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbldashboard');
    }
};
