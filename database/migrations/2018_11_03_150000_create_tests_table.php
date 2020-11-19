<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
			$table->increments('position'); //need to make sure this works or change to $table->integer('position')->unsigned();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->integer('no_of_examiner')->unsigned();
            $table->timestamps();
            $table->softDeletes();// deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
