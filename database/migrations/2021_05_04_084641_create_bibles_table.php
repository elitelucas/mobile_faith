<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibles', function (Blueprint $table) {
            $table->id();
            $table->string('language')->nullable();
            $table->string('damID')->default('');
            $table->string('volume_name')->default('');
            $table->string('bookID')->default('');
            $table->string('chapterID')->default('');
            $table->string('audio_path')->nullable();
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
        Schema::dropIfExists('bibles');
    }
}
