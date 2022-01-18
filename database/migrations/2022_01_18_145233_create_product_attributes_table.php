<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('price')->nullable();
            $table->foreignId('product_id')->constrained();
            $table->timestamps();

            /*You might be wondering, we already have the quantity column in products table, so why have it in the product attributes table.
            The only reason for defining the quantity in both tables is, there can be some products which don’t have attributes. So we can use the quantity column from the products table.*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
