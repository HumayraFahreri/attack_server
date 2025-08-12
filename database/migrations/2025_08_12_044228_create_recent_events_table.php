<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recent_events', function (Blueprint $table) {
            $table->id();
            $table->string('source_ip'); // IP penyerang
            $table->string('target_ip'); // IP target
            $table->string('attack_type'); // jenis serangan
            $table->integer('duration')->nullable(); // durasi dalam detik
            $table->integer('packets_sent')->nullable(); // jumlah paket
            $table->timestamp('event_time'); // waktu serangan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recent_events');
    }
};
