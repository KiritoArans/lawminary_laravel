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
        Schema::create('tblrates', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 20)->nullable();
            $table->string('comment_id', 24)->nullable();
            $table->string('lawyerUser_id', 20)->nullable();
            $table->integer('rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblrates');
    }
};
