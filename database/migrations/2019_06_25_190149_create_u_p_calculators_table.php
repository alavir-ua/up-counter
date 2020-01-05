<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUPCalculatorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('u_p_calculators', function (Blueprint $table) {

			$table->bigIncrements('id');

			$table->bigInteger('user_id')->unsigned();

			$table->string('electricity')->nullable();
			$table->string('gaz')->nullable();
			$table->string('water')->nullable();
			$table->string('heat')->nullable();
			$table->string('utilities')->nullable();
			$table->string('intercom')->nullable();
			$table->string('total')->nullable();

			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('u_p_calculators');
	}
}
