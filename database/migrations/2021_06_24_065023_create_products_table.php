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
            $table->string('barcode')->unique();
            $table->string('product_name');
            $table->foreignId('category_id')->references('id')->on('product_categories')
                ->onDelete(null);
            $table->foreignId('material_id')->references('id')->on('materials')
                ->onDelete(null);
            $table->integer('quantity');
            $table->string('unit');
            $table->integer('retail_price');
            $table->integer('purchase_price');
            $table->foreignId('vendor_id')->references('id')
                    ->on('vendors')->onDelete(null);
            $table->json('images');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
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
