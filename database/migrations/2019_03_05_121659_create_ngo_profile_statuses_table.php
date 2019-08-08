<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgoProfileStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngo_profile_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ngo_profile_id')->unsigned();
            $table->string('status')->nullable();
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('ngo_profile_statuses');
    }
}
