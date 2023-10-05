<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->enum('status', OrderStatus::values()); //ezz
            // $table->enum('fee_type', GeneralFees::values()); //ezz
            $table->string('ip')->nullable(); //ezz
            $table->text('approximate_location')->nullable(); //ezz
            $table->string('name');//
            $table->text('address');//
            $table->string('city');//
            $table->string('phone');//
            $table->text('landing_page')->nullable();//www.
            $table->text('notice')->nullable();//
            $table->text('comment')->nullable();//null
            $table->text('reject_reason')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->integer('product_number');
            $table->bigInteger('final_price');
            $table->string('marketer_id')//auth
                ->nullable()
                ->constrained()
                ->cascadeSetNull();
            $table->string('country_id')//country
                ->nullable()
                ->constrained()
                ->cascadeSetNull();
            $table->string('operator_id')//null
                ->nullable()
                ->constrained()
                ->cascadeSetNull();
            $table->timestamp('operator_start_call_at')->nullable();
            $table->timestamp('operator_end_call_at')->nullable();
            $table->integer('time_with_order')->nullable();
            $table->timestamp('delayed_to')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
