<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deleted_chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->string('chapter_number')->nullable();
            $table->unsignedBigInteger('manhwa_id')->nullable();
            $table->unsignedBigInteger('wp_chapter_id')->nullable();
            $table->text('reason')->nullable(); // Reason for deletion
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deleted_chapters');
    }
};
