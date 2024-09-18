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
        Schema::create('tblsyscon', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path', 100)->nullable();
            $table->string('system_name', 50);
            $table->text('about_lawminary');
            $table->text('about_pao');
            $table->text('terms_of_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblsyscon');
    }
};
