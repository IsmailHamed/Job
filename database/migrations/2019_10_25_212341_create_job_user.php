<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_user', function (Blueprint $table) {
            $table->timestamps();
            $table->string('message');
            $table->bigInteger('job_id')->unsigned();

            $table->bigInteger('user_id')->unsigned();

            $table->foreign('job_id')->references('id')->on('jobs')

                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')

                ->onDelete('cascade');
            $table->primary(['job_id', 'user_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_user');
    }
}
