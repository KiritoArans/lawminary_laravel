<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblrestrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblrestrict', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Define user_id column
            $table->integer('restrict_days'); // Number of restriction days
            $table->timestamps(); // Created and updated timestamps

            // Add foreign key constraint for user_id referencing tblaccounts
            $table
                ->foreign('user_id')
                ->references('user_id')
                ->on('tblaccounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblrestrict');
    }
}
