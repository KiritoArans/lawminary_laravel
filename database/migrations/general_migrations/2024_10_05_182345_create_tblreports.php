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
        Schema::create('tblreports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id', 20);
            $table->string('post_id', 24);
            $table->string('user_id', 20);
            $table->string('reportContent', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblreports');
    }
};
