<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisteredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registereds', function (Blueprint $table) {
            $table->primary(['user_id', 'offer_id']);
            $table->unsignedInteger('user_id')->unsigned();
            $table->boolean('acepted')->default(false);
            $table->unsignedInteger('offer_id')->unsigned();



            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
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
        Schema::dropIfExists('registereds');
    }
}
