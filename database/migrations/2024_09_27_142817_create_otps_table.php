<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpsTable extends Migration
{
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('otp', 16);
            $table->timestamp('expires_at');
            $table->string('purpose', 16);
            $table->timestamps();

            $table
                ->foreign('user_id')
                ->references('user_id')
                ->on('tblaccounts')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('otps');
    }
}
