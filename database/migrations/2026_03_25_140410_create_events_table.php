<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The Organizer [cite: 66]
            $table->string('title');
            $table->text('description');
            $table->string('venue');
            $table->dateTime('event_date');
            $table->integer('total_seats'); // Max allowed [cite: 66]
            $table->integer('booked_seats')->default(0); // Current count [cite: 66]
            $table->timestamps();
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
