<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('tblsyscon', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path', 100)->nullable();
            $table->string('dev_name', 100)->nullable();
            $table->string('system_name', 100)->nullable();
            $table->string('system_desc', 1000)->nullable();
            $table->string('system_desc2', 1000)->nullable();
            $table->string('partner_name', 100)->nullable();
            $table->string('partner_desc', 1000)->nullable();
            $table->string('partner_desc2', 1000)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblsyscon');
    }
};
