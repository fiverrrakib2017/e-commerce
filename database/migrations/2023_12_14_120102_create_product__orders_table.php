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
        Schema::create('product__orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('sub_total');
            $table->double('discount');
            $table->double('delivery_charge');
            $table->double('tax_amount');
            $table->integer('grand_total');
            $table->integer('payment_status');
            $table->text('note')->nullable();
            $table->integer('order_status');//pending', 'shiped', 'delivered', 'cancelled'
            $table->double('shipping_id');
            $table->text('coupon_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email_address');
            $table->string('phone_number');
            $table->string('country');
            $table->string('address');
            $table->string('appartment');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->timestamps();

            
            $table->foreign('user_id')
                ->references('id') 
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product__orders');
    }
};
