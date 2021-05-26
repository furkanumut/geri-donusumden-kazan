<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecyclingOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recycling_operations', function (Blueprint $table) {
            $table->id();
            $table->string('recycling_photo');
            $table->string('recycling_bin_photo')->nullable();
            $table->enum('verified', ['bin_image_wait', 'approved_wait', 'not_approved', 'approved'])->default('bin_image_wait');
            $table->boolean('is_payment_received')->default('0');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recycling_operations');
    }
}
