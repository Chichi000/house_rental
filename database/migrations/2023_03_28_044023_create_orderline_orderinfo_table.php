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
        Schema::create('orderinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')->references('id')->on('tenants');  
            $table->integer('total_days');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('payment_method');
            $table->decimal('total_amount', 10, 2);
            $table->text('status')->default('Pending');
            $table->timestamps();
        });

        Schema::create('orderline', function (Blueprint $table) {
            $table->integer('orderinfo_id')->unsigned();
            $table->foreign('orderinfo_id')->references('id')->on('orderinfo');
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderinfo');
        Schema::dropIfExists('orderline');
    }
};
