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
        Schema::table('manhwas', function (Blueprint $table) {
            $table->string('deep_check')->nullable()->default(false)->after('mgdemon_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manhwas', function (Blueprint $table) {
            $table->dropColumn(['deep_check']);
        });
    }
};
