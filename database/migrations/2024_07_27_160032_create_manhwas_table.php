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
        Schema::create('manhwas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('manhwafast_link')->nullable();
            $table->string('manhwaclan_link')->nullable();
            $table->string('tecnoscans_link')->nullable();
            $table->integer('starting_limit')->nullable()->default(null);
            $table->integer('post_id')->nullable();
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
        Schema::dropIfExists('manhwas');
    }
};
