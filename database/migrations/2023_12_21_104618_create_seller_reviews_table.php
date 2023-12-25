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
        Schema::create('seller_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->text('comment');
            $table->text('rating');
            $table->text('photo')->nullable();
            $table->integer('status');
            $table->timestamps();
        
            $table->foreign('seller_id')
                ->references('id') 
                ->on('sellers')
                ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_reviews');
    }
};
