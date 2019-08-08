<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNgoPrfilesToBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngo_profiles', function (Blueprint $table) {
            $table->string('contact_person_name')->nullable()->after('logo');
            $table->string('contact_person_designation')->nullable()->after('contact_person_name');
            $table->string('bank_name')->nullable()->after('contact_person_designation');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('account_type')->nullable()->after('account_number');
            $table->string('ifsc_code')->nullable()->after('account_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
