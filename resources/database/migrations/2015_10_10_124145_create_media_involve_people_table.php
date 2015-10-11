<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaInvolvePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media_involve_people', function(Blueprint $table)
		{
			$table->increments('id');
            $table->tinyInteger('organization_id');
            $table->string('name')->nullable();
            $table->string('designation', 50)->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('email', 50)->nullable();
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
		Schema::drop('media_involbe_people');
	}

}
