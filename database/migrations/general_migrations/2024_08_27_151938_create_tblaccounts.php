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
        Schema::create('tblaccounts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('username');
            $table->string('email');
            $table->string('password');

            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->integer('birthDate');
            $table->string('nationality');
            $table->string('sex');
            $table->integer('contactNumber');

            $table->string('userEmail');
            $table->string('restrict');
            $table->string('restrictDays');

            $table->string('date_created');
            $table->string('account_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblaccounts');
    }
};
