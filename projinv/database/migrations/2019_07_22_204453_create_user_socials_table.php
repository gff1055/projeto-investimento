<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_socials', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->string('social_network');
            $table->string('social_id');
            $table->string('social_email');
            $table->string('social_avatar');

            $table->timestamps();

            // chaves estrangeiras
            $table->foreign('user_id')->reference('id')->on('users');
            $table->foreign('social_email')->reference('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // removendo os relacionamentos
        Schema::table('user_socials', function(Blueprint $table){
            $table->dropForeign('user_socials_id_foreign');
            $table->dropForeign('user_socials_social_email_foreign');
        });
        
        Schema::dropIfExists('user_socials');
    }
}
