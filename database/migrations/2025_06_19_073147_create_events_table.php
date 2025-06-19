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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('timezone');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('utc_start_date');
            $table->dateTime('utc_end_time');
            $table->string('location');
            $table->decimal('member_price', 10, 2)->default(0);
            $table->decimal('non_member_price', 10, 2)->default(0);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
