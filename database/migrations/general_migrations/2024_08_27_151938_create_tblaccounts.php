<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tblaccounts', function (Blueprint $table) {
            $table->id(); // This is the auto-increment primary key column
            $table->unsignedBigInteger('user_id')->nullable(); // user_id without auto-increment
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('userPhoto', 255)->nullable();
            $table->string('password', 100);
            $table->string('firstName', 100);
            $table->string('middleName', 100)->nullable();
            $table->string('lastName', 100);
            $table->date('birthDate');
            $table->string('nationality', 100);
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->string('contactNumber', 11);
            $table->string('status', 15)->nullable();
            $table->boolean('restrict')->default(false);
            $table->integer('restrictDays')->nullable(); // Removed auto-increment
            $table->enum('accountType', ['User', 'Moderator', 'Lawyer', 'Admin']);
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

