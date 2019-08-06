<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailPdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_pdfs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_to_test_id')->unsigned();
            $table->integer('examiner_id')->unsigned();
            $table->string('mailpdf');
            $table->text('questions')->nullable();
            $table->text('answers')->nullable();
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
        Schema::dropIfExists('mail_pdfs');
    }
}
