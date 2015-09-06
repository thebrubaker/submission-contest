<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('facebook_id')->nullable()->default(NULL);
            $table->string('access_token')->nullable()->default(NULL);
            $table->string('first_name')->nullable()->default(NULL);
            $table->string('last_name')->nullable()->default(NULL);
            $table->date('date_of_birth')->nullable()->default(NULL);
            $table->integer('zip_code')->nullable()->default(NULL);
            $table->string('profile_photo')->nullable()->default(NULL);
            $table->json('facebook_friends')->nullable()->default(NULL);
            $table->json('page_likes')->nullable()->default(NULL);
            $table->timestamps();
        });

        Schema::table('profiles', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function($table) {
            $table->dropForeign('profiles_user_id_foreign');
        });

        Schema::drop('profiles');
    }
}
