<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWriteUpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('write_ups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('employee');
			$table->softDeletes();
			$table->string("writeUp");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('write_ups');
	}

}
