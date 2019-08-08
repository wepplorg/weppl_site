<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngo_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ngo_profile_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->foreign('ngo_profile_id')->references('id')->on('ngo_profiles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('ngo_users');
    }
}
