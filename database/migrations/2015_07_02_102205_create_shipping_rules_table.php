<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipping_rules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->softDeletes();

            $table->unsignedInteger('carrier_id');
            $table->unsignedInteger('country_id');
            $table->boolean('is_enabled')->default(false);
            $table->integer('delivery_time')->nullable();

            $table->unique(['carrier_id', 'country_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shipping_rules');
	}

}
