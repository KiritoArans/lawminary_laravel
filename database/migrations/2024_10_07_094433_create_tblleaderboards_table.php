<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblleaderboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblleaderboards', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->string('lawyerUser_id'); // Foreign key from tblpoints
            $table->string('rank', 10); // Lawyer's rank (e.g., Wood, Steel, Bronze, etc.)
            $table->integer('rankPoints'); // Total points for the lawyer
            $table->integer('position')->nullable(); // Rank position (e.g., 1 for top 1, etc.)
            $table->timestamps(); // created_at and updated_at columns

            // Optionally, you could add a foreign key constraint if `lawyerUser_id` references another table:
            // $table->foreign('lawyerUser_id')->references('id')->on('tblpoints')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblleaderboards');
    }
}
