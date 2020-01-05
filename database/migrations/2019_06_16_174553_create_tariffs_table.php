<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tariffs', function (Blueprint $table) {

			$table->bigIncrements('id');

			$table->bigInteger('user_id')->unsigned();
			$table->string('elect_before')->nullable();
			$table->string('elect_under')->nullable();
			$table->string('gaz_t')->nullable();
			$table->string('water_t')->nullable();
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
		Schema::dropIfExists('tariffs');
	}
}
