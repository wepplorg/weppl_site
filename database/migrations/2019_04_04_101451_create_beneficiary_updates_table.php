<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('beneficiary_id')->unsigned();
            $table->integer('ngo_id')->unsigned();
            $table->longText('description')->nullable();
            $table->string('status')->comment('1:Request;2:Approved;3:Rejected;')->nullable();
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ngo_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('beneficiary_updates');
    }
}
