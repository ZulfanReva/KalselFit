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
        Schema::create('subscribe_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('booking_trx_id');
            $table->string('proof');
            $table->string('total_amount');
            $table->date('started_at');
            $table->date('ended_at');
            $table->integer('duration');
            $table->foreignId('subscribe_package_id')->constrained()->onDelete('cascade');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribe_transactions');
    }
};
