<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tblposts', function (Blueprint $table) {
            $table->id();
            $table->string('post_id', 24);
            $table->string('concern', 255);
            $table->string('concernCategory', 100);
            $table->string('concernPhoto', 255)->nullable();
            $table->string('postedBy', 50);
            $table->string('status', 15);
            $table->string('tags', 125)->nullable();
            $table->string('privacy', 10);
            $table->string('approvedBy', 100)->nullable();
            $table->string('reasonDisregard', 100)->nullable();
            $table->timestamp('last_notified_at')->nullable(); // Add the new column here
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblposts');
    }
};
