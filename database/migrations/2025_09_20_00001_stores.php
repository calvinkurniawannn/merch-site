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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            // basic store identity
            $table->string('account_code')->unique();
            $table->string('store_name');
            $table->string('logo')->nullable(); // path/logo image
            $table->string('theme_color')->nullable();

            // optional info about seller
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            $table->string('modified_by')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->string('created_by');
            $table->timestamp('created_date');

            // audit info
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_accounts');
    }
};