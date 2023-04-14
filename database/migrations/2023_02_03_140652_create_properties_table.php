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
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('advisor_id_fk');
            $table->integer('landlord_id')->unsigned();
            $table->foreign('landlord_id')->references('id')->on('landlords')->onDelete('cascade');
            $table->string('area');
            $table->string('garage');
            $table->string('bathroom');
            $table->string('bedroom');
            // $table->string('ownername');
            $table->string('rent');
            $table->string('city');
            $table->string('state');
            $table->string('address');
            $table->text('description');
            $table->string('imagePath')->nullable();
            $table->boolean('is_approved')->default('0');
            $table->boolean('is_taken')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
