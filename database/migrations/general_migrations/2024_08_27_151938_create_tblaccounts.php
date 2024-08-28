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
            $table->id(); 
            $table->unsignedBigInteger('user_id', 20);
            $table->string('username', 50)->unique(); 
            $table->string('email', 100)->notNull();
            $table->string('password', 100)->notNull();
            $table->string('firstName', 100)->notNull();
            $table->string('middleName', 100)->nullable();
            $table->string('lastName', 100)->notNull();
            $table->date('birthDate')->notNull();
            $table->string('nationality', 100)->nullable();
            $table->string('sex', 10)->notNull();
            $table->string('contactNumber', 11)->notNull();
            $table->string('restrict', 50)->nullable();
            $table->string('restrictDays', 50)->nullable();
            $table->string('account_type', 50)->nullable();
            $table->timestamps();
        });

        Schema::table('tblaccounts', function (Blueprint $table) {
            $table->string('username', 50)->unique()->change();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblaccounts');
        
        Schema::table('tblaccounts', function (Blueprint $table) {
            $table->dropUnique(['username']);
        });
    }
};
