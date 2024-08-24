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
        Schema::table('index_chapters', function (Blueprint $table) {
            $table->string('indexed_url')->nullable()->after('chapter_id');
            $table->string('response')->nullable()->after('indexed_url');

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
            $table->dropColumn(['indexed_url','response']);
        });
    }
};
