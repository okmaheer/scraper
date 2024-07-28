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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->unsignedBigInteger('businessunit_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->uuid('uid');
            $table->string('ssn');
            $table->string('pan');
            $table->string('name');
            $table->string('name_per_incorporation');
            $table->string('chief');
            $table->string('email');
            $table->string('postal_address');
            $table->string('building_name')->nullable();
            $table->string('locality_or_colony')->nullable();
            $table->string('state')->nullable();
            $table->string('cin_number');
            $table->string('contact_number');
            $table->string('pin_code');
            $table->string('door_number');
            $table->string('plot_number');
            $table->string('road_number');
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
        Schema::dropIfExists('business_units');
    }
};
