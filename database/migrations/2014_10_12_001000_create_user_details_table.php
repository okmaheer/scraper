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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('contact_number');
            $table->string('pan')->nullable();
            $table->string('ssn')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('medical_license_registration_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('dental_council_name')->nullable();
            $table->string('building_name')->nullable();
            $table->string('locality_or_colony')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->text('postal_address')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('door_number')->nullable();
            $table->string('plot_number')->nullable();
            $table->string('road_number')->nullable();
            $table->date('dob')->nullable();
            $table->date('license_issue_date')->nullable();
            $table->date('start_date')->nullable();
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
};
