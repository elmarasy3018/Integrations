<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marketer_stores', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('marketer_id')->constrained();
            $table->text('url')->comment('url or domain')->nullable();
            $table->text('access_token')->comment('consumer_secret+access_token')->nullable();
            $table->text('consumer_key')->nullable();
            // $table->enum('type', StoreType::values());
            $table->string('last_order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketer_stores');
    }
};
