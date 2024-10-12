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
        Schema::create('products', function (Blueprint $table) {
            $table->char('id')->primary();
            $table->string('product_name',length:255);
            $table->text('description')->nullable();
            $table->double('retail_price')->default(0.0);
            $table->double('wholesale_price')->default(0.0);
            $table->char('origin',length:2);
            $table->unsignedInteger('quantity')->default(0);
            $table->text('product_image')->nullable();
            $table->timestamp('created_at',0)->userCurrent();
            $table->timestamp('updated_at',0)->userCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
