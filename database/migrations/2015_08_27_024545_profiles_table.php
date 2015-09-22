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
            $table->string('facebook_id')->unique();
            $table->string('access_token');
            $table->string('first_name')->nullable()->default(NULL);
            $table->string('last_name')->nullable()->default(NULL);
            $table->string('age_range')->nullable()->default(NULL);
            $table->string('gender')->nullable()->default(NULL);
            $table->string('location')->nullable()->default(NULL);
            $table->string('hometown')->nullable()->default(NULL);
            $table->string('profile_photo')->nullable()->default(NULL);
            $table->string('devices')->nullable()->default(NULL);
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
