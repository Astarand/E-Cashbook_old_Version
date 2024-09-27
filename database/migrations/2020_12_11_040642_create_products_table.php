<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('folder');
			$table->string('image');
			$table->integer('time')->length(11);
			$table->string('product_title');
			$table->string('product_desc');
			$table->string('url');
			$table->integer('quantity')->length(11);
			$table->integer('procurement')->unsigned()->length(10);
			$table->integer('brand_id')->length(11);
			$table->double('price',10,2);
			$table->double('old_price',10,2);
			$table->integer('user_id')->length(11);
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
        Schema::dropIfExists('products');
    }
}
