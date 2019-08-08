<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgoProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngo_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ngo_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->longText('description')->nullable();
            $table->string('pincode')->nullable();
            $table->string('document')->nullable();
            $table->tinyinteger('verify')->comment('1:Verified;0:Not-Verified;')->nullable();
            $table->tinyinteger('terms')->comment('1:Accepted;0:Not-Accepted')->nullable();
            $table->string('status')->comment('1:Request;2:Approved;3:Rejected;')->nullable();
            $table->foreign('ngo_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('ngo_profiles');
    }
}
