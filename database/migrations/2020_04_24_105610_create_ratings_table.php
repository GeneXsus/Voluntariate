<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->primary(['rating_by', 'rating_to']);
            $table->integer('rating_by')->unsigned();
            $table->integer('rating_to')->unsigned();
            $table->integer('rate');
            $table->text('description')->nullable();

            $table->foreign('rating_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('rating_to')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
