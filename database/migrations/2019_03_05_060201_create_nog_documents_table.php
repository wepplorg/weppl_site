<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNogDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngo_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ngo_profile_id')->unsigned();
            $table->string('registration_document')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('reg_12a_doc')->nullable();
            $table->string('reg_80g_doc')->nullable();
            $table->string('audi_statement')->nullable();
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
        Schema::dropIfExists('ngo_documents');
    }
}
