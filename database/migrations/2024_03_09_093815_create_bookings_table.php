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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('fullname');
            $table->string('email');
            $table->string('contact');
            $table->tinyInteger('local_guests')->default(0);
            $table->tinyInteger('foreign_guests')->default(0);
            $table->date('event_date');
            $table->text('pick_up_info')->nullable();
            $table->text('special_requests')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
