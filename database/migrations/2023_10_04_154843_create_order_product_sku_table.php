<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_product_sku', function (Blueprint $table) {
            $table->id();
            $table->string('trader_id')->nullable() //ezz
                ->constrained()
                ->cascadeSetNull();
            $table->string('product_sku_id') //sku
                ->nullable()
                ->constrained('product_skus')
                ->cascadeSetNull();
            $table->string('order_id') //ezz
                ->nullable()
                ->constrained()
                ->cascadeSetNull();
            $table->string('type'); //normal
            $table->bigInteger('quantity'); //
            $table->double('piece_price'); //القطعة
            $table->double('final_price_for_product'); // القطعة * العدد
            $table->unsignedBiginteger('user_delete_product')->nullable();
            $table->foreign('user_delete_product')->references('id')->on('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_product_sku');
    }
};
