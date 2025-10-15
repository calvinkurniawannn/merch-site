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
        Schema::create('pre_order_campaigns', function (Blueprint $table) {
            $table->id('campaign_id');

            // Relasi ke seller
            $table->string('account_code')->nullable();
            $table->foreign('account_code')->references('account_code')->on('stores')->onDelete('cascade');

            // Informasi campaign
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->string('slug', 100)->unique();

            // Tanggal periode preorder
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Status campaign
            $table->enum('status', ['Active', 'Closed'])->default('Active');

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
        Schema::dropIfExists('pre_order_campaigns');
    }
};
