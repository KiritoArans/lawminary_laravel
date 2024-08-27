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
        Schema::create('tbladaccounts', function (Blueprint $table) {
            $table->id();
            $table->string('userRole');
            $table->string('lwyrUserid')->unique();
            $table->string('lwyrUsername')->unique();
            $table->string('lwyrPassword');
            $table->string('lwyrFirstName');
            $table->string('lwyrLastName');
            $table->string('lwyrUserEmail')->unique();
            $table->boolean('restrict')->default(false);
            $table->integer('restrictDays')->nullable();
            $table->boolean('block')->default(false);
            $table->boolean('approve')->default(false);
            $table->integer('actPoints')->default(0);
            $table->string('userBadge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbladaccounts');
    }
};
