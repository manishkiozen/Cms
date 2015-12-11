<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->softDeletes();

            $table->string('description');
            $table->string('detailed_description')->nullable();

            $table->string('product_number', 20)->unique();
            $table->string('ean', 13)->nullable();

            $table->float('purchase_price')->nullable();
            $table->float('selling_price')->nullable();
            $table->float('recommended_retail_price')->nullable();

            $table->integer('delivery_time')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
