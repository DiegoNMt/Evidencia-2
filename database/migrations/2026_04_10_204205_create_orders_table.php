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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->date('order_date');
            $table->enum('status', [
                'Pending',
                'In process',
                'Loaded',
                'Delivered'
            ])->default('Pending');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('processed_by')->nullable();
            $table->unsignedBigInteger('delivered_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');

            $table->foreign('processed_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('delivered_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
