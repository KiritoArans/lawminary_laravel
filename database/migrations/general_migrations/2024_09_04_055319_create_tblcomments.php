<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tblcomments', function (Blueprint $table) {
            $table->id();
            $table->string('comment_id', 13);
            $table->string('user_id', 50);
            $table->string('post_id', 13);
            $table->string('comment', 255);
            $table->string('likes', 10)->nullable();
            $table->string('likesQty', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tblcomments');
    }
};
