<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialToNgoProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngo_profiles', function (Blueprint $table) {
            $table->string('facebook_share')->nullable()->after('document');
            $table->string('twitter_share')->nullable()->after('facebook_share');
            $table->string('website_url')->nullable()->after('twitter_share');
            $table->tinyinteger('decalration')->nullable()->after('website_url');
            $table->string('date_incorporation')->nullable()->after('website_url');
            $table->string('addtional_document')->nullable()->after('date_incorporation');
            $table->string('document_agree')->nullable()->after('addtional_document');
            $table->string('document_terms')->nullable()->after('document_agree');
            
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
