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
        Schema::create('tblforumposts', function (Blueprint $table) {
            $table->id();
            $table->string('post_id', 24);
            $table->string('forum_id', 13);
            $table->string('concern', 255);
            $table->string('concernPhoto', 255)->nullable();
            $table->string('postedBy', 50);
            $table->string('status', 15)->nullable();
            $table->string('approvedBy', 100)->nullable();
            $table->string('reasonDisregard', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblforumposts');
    }
};
