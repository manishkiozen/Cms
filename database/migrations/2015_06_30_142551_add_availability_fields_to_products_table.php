<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailabilityFieldsToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
            $table->unsignedInteger('supplier_id')->nullable();
			$table->boolean('can_be_purchased')->default(false);
			$table->boolean('can_be_sold')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropColumn(['supplier_id', 'can_be_purchased', 'can_be_sold']);
		});
	}

}
