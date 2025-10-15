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

            // login identity
            $table->string('username')->unique(); // tambah username
            $table->string('password')->nullable(); // guest bisa null

            // basic info
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // role system
            $table->enum('role', ['guest', 'user', 'admin_seller'])->default('user');

            // profile info
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();

            // if user is admin_seller, link to seller_account
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')
                ->references('id')->on('stores')
                ->onDelete('cascade');

            // audit fields
            $table->string('modified_by')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->string('created_by');
            $table->timestamp('created_date');

            $table->rememberToken();
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
