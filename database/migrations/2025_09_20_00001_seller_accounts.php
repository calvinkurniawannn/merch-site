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
        Schema::create('seller_accounts', function (Blueprint $table) {
            $table->id();

            // basic store identity
            $table->string('store_name');
            $table->string('logo')->nullable(); // path/logo image
            $table->string('theme_color')->nullable();

            // optional info about seller
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

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
