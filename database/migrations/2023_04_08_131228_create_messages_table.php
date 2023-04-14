<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('message_sender_user')->unsigned()->nullable();
            $table->integer('message_sender_user')->unsigned();
            $table->foreign('message_sender_user')->references('id')->on('users')->onDelete('cascade');
            $table->longText('message_text');
            $table->boolean('is_user_1_seen');
            $table->boolean('is_user_2_seen');
            $table->datetime('message_send_at');
            // $table->integer('conversation_id')->unsigned()->nullable();
            $table->integer('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
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
};
