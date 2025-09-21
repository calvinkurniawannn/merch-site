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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // basic info
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // guest bisa null

            // role system
            $table->enum('role', ['guest', 'user', 'admin_seller'])->default('user');

            // profile info (for customer/user autofill)
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            // if user is admin_seller, link to seller_account
            $table->unsignedBigInteger('seller_account_id')->nullable();
            $table->foreign('seller_account_id')
                ->references('id')->on('seller_accounts')
                ->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
