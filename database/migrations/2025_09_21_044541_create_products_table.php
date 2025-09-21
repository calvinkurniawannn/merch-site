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

            $table->string('image');       
            $table->string('name');         
            $table->text('description');    
            $table->decimal('price', 12, 2); 
            $table->integer('quantity');

            $table->unsignedBigInteger('seller_account_id')->nullable();
            $table->foreign('seller_account_id')
                ->references('id')->on('seller_accounts')
                ->onDelete('cascade');

            $table->string('modified_by')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->string('created_by');
            $table->timestamp('created_date');

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