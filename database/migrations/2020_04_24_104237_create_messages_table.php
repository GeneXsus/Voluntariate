<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->string('name',200);
            $table->integer('chat_id')->unsigned();
            $table->integer('user_send_id')->unsigned();
            $table->integer('user_receiver_id')->unsigned();
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();
            $table->foreign('user_send_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('user_receiver_id')
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
        Schema::dropIfExists('messages');
    }
}
