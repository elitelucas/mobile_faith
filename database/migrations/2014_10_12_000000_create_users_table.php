<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('deviceToken')->nullable();
            $table->string('fbID')->nullable();
            $table->string('googleID')->nullable();
            $table->string('appleID')->nullable();
            $table->string('prayTime')->nullable();
            $table->boolean('enablePush')->default(1);
            $table->boolean('enableEmail')->default(1);
            $table->string('bibleLanguageCode')->default('ENG');
            $table->string('bibleLanguageName')->default('English');
            $table->string('bibleVersionCode')->nullable();
            $table->string('bibleVersionName')->nullable();
            $table->integer('religionID')->nullable();
            $table->boolean('paid')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
