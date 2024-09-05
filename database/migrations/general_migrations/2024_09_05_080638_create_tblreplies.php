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
        Schema::create('tblreplies', function (Blueprint $table) {
            $table->id();
            $table->string('reply_id', 13);
            $table->string('comment_id', 13);
            $table->string('user_id', 50);
            $table->string('post_id', 13);
            $table->string('reply', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblreplies');
    }
};
