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
            $table->id();

            $table->string('image')->nullable();       
            $table->string('name');         
            $table->text('description');    
            $table->decimal('price', 12, 2); 
            $table->integer('quantity');

            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')
                ->references('id')->on('stores')
                ->onDelete('cascade');

            $table->string('modified_by')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->string('created_by');
            $table->timestamp('created_date');

            $table->string('slug')->nullable();
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