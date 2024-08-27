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
        Schema::create('tblmaccounts', function (Blueprint $table) {
            $table->id();
            $table->string('modUserid')->unique();
            $table->string('modUsername')->unique();
            $table->string('modPassword');
            $table->string('modFirstName');
            $table->string('modLastName');
            $table->string('modUserEmail')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblmaccounts');
    }
};
