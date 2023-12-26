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
        Schema::create('pickup_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->string('name');
            $table->text('address');
            $table->integer('phone');
            $table->integer('pick_up_status')->nullable();
            $table->integer('cash_on_pickup_status')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')
            ->references('id') 
            ->on('staff')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_points');
    }
};
