<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media_organizations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('editor_name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city', 50);
            $table->string('country', 50);
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->string('fax', 20);
            $table->string('website');
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
		Schema::drop('media_organizations');
	}

}
