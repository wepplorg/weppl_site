<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ngo_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('feature_id')->unsigned();
            $table->integer('ngo_user_id')->unsigned();
            $table->string('age')->nullable();
            $table->string('title')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('goal_amount')->nullable();
            $table->string('document')->nullable();
            $table->string('status')->comment('1:Request;2:Approved;3:Rejected;')->nullable();
            $table->foreign('ngo_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('feature_id')->references('id')->on('features')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ngo_user_id')->references('id')->on('ngo_users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('beneficiaries');
    }
}
