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
        Schema::create('seller_withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->double('amount');
            $table->date('withdraw_date');
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
        Schema::dropIfExists('seller_withdraws');
    }
};
