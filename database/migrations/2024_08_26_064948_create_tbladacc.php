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
        Schema::create('tbladacc', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->string('adUserid'); // String column for user ID
            $table->string('adUsername'); // String column for username
            $table->string('adPassword'); // String column for password
            $table->string('adFirstName'); // String column for first name
            $table->string('adLastName'); // String column for last name
            $table->string('adUserEmail'); // String column for email
            $table->timestamps(); // Columns for created_at and updated_at
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbladacc');
    }
};
