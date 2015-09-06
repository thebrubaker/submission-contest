<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('submission_id')->unsigned();
            $table->integer('value')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('votes', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('submission_id')
                ->references('id')->on('submissions')
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
        Schema::table('votes', function($table)
        {
            $table->dropForeign('votes_user_id_foreign');
            $table->dropForeign('votes_submission_id_foreign');
        });
        Schema::drop('votes');
    }
}
