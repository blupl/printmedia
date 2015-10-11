<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaReportersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media_reporters', function(Blueprint $table)
		{
			$table->increments('id');
            $table->tinyInteger('organization_id');
            $table->string('name');
            $table->integer('personal_id');
            $table->string('gender', 20);
            $table->date('date_of_birth');
            $table->string('mobile', 20);
            $table->string('email', 50);
            $table->string('role', 25);
            $table->string('work_station', 25);
            $table->string('photo');
            $table->string('card_collection_point', 25);
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
		Schema::drop('media_reporters');
	}

}
