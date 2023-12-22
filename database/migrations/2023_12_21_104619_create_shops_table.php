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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->text('logo');
            $table->text('slider');
            $table->text('top_banner');
            $table->text('banner_full_width_1');
            $table->text('banners_half_width');
            $table->text('banner_full_width_2');
            $table->string('phone');
            $table->text('address');
            $table->string('rating');
            $table->integer('num_of_reviews');
            $table->integer('num_of_sale');
            $table->integer('seller_id');
            $table->integer('product_upload_limit');
            $table->date('package_invalid_at');
            $table->integer('verification_status');
            $table->text('verification_info');
            $table->integer('cash_on_delivery_status');
            $table->integer('admin_to_pay'); 
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('google')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('slug')->nullable();
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->integer('pick_up_point_id');
            $table->integer('shipping_cost');
            $table->text('delivery_pickup_latitude')->nullable();
            $table->text('delivery_pickup_longitude')->nullable();
            $table->string('bank_name');
            $table->string('bank_acc_name');
            $table->integer('bank_acc_no');
            $table->integer('bank_routing_no');
            $table->integer('bank_payment_status');
            $table->timestamps();

            // $table->foreign('seller_id')
            // ->on('sellers')
            // ->references('on')
            // ->onDelete('cascade');

            // $table->foreign('pick_up_point_id')
            // ->on('pickup_points')
            // ->references('on')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
