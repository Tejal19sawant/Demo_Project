<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesAssocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes_assoc', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned()->index()->foreign()->references("id")->on("product")->onDelete("cascade");
            $table->string('sku');
            $table->string('size');
            $table->integer('price');
            $table->integer('stock');
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
        Schema::dropIfExists('product_attributes_assoc');
    }
}
