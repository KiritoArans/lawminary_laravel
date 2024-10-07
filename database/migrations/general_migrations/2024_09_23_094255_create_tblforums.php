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
        Schema::create('tblforums', function (Blueprint $table) {
            $table->id();
            $table->string('forum_id', 24);
            $table->string('forumName', 50);
            $table->string('forumPhoto', 255)->nullable();
            $table->string('forumDesc', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblforums');
    }
};
