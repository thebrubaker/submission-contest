<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('image_path');
            $table->string('thumbnail_path');
            $table->string('caption')->nullable()->default(NULL);
            $table->string('location')->nullable()->default(NULL);
            $table->integer('vote_cache')->unsigned()->default(0);
            $table->boolean('approved')->default(NULL);
            $table->timestamps();
        });

        Schema::table('submissions', function(Blueprint $table) {
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
        Schema::table('submissions', function($table) {
            $table->dropForeign('submissions_user_id_foreign');
        });
        Schema::drop('submissions');
    }
}
