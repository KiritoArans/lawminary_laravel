<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tblaccounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('userPhoto', 255)->nullable();
            $table->string('idPhoto', 255)->nullable();
            $table->string('password', 100);
            $table->string('firstName', 100);
            $table->string('middleName', 100)->nullable();
            $table->string('lastName', 100);
            $table->string('address', 255);
            $table->date('birthDate');
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->string('address', 100)->nullable();
            $table->string('lawyerID', 50)->nullable();
            $table->string('fieldExpertise', 100)->nullable();
            $table->string('status', 15)->nullable();
            $table->boolean('restrict')->default(false);
            $table->integer('restrictDays')->nullable();
            $table->enum('badge', [
                'Wood',
                'Steel',
                'Bronze',
                'Silver',
                'Gold',
                'Diamond',
            ]);
            $table->enum('accountType', [
                'User',
                'Moderator',
                'Lawyer',
                'Admin',
            ]);
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
