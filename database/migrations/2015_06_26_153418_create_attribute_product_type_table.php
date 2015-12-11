<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeProductTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_product_type', function(Blueprint $table)
		{
			$table->increments('id');

            $table->unsignedInteger('attribute_id');
            $table->unsignedInteger('product_type_id');

            $table->unique(['attribute_id', 'product_type_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_product_type');
	}

}
