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
    Schema::table('tblposts', function (Blueprint $table) {
        $table->string('post_id', 255)->change(); // Adjust the length as needed
    });
}

public function down(): void
{
    Schema::table('tblposts', function (Blueprint $table) {
        $table->string('post_id', 13)->change(); // Revert to the original length if necessary
    });
}

};
