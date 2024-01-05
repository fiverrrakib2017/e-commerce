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
            $table->string('name');
            $table->unsignedBigInteger('seller_id');
            $table->text('logo');
            $table->text('slider');
            $table->text('top_banner');
            $table->text('banner_full_width_1')->nullable(); 
            $table->text('banner_full_width_2')->nullable();
            $table->text('banner_half_width')->nullable();
           
            $table->integer('product_upload_limit')->nullable();
            $table->integer('verification_status');
            $table->text('verification_info')->nullable();
            $table->integer('cash_on_delivery_status');
            $table->integer('admin_to_pay')->nullable(); 
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('google')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('slug')->nullable();
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->unsignedBigInteger('pickup_point_id');
            $table->integer('shipping_cost');
            $table->text('delivery_pickup_latitude')->nullable();
            $table->text('delivery_pickup_longitude')->nullable();
           
            $table->timestamps();

            $table->foreign('seller_id')
            ->references('id') 
            ->on('sellers')
            ->onDelete('cascade');

            $table->foreign('pickup_point_id')
            ->references('id') 
            ->on('pickup_points')
            ->onDelete('cascade');

          
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
