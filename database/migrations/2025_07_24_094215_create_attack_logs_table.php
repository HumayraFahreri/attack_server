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
        Schema::create('attack_logs', function (Blueprint $table) {
            $table->id();
            $table->string('attack_ip', 45);
            $table->string('target_ip', 45);
            $table->enum('type', ['TCP Flood', 'UDP Flood', 'ICMP Flood', 'DDoS', 'Other']); // Contoh enum
            $table->string('target', 100)->nullable();
            $table->enum('severity', ['Low', 'Medium', 'High', 'Critical']); // Menggunakan enum
            $table->enum('status', ['Monitored', 'Blocked', 'Allowed']); // Menggunakan enum
            $table->text('details')->nullable();
            $table->timestamps(); // Ini sudah mencakup created_at dan updated_at

            // Indeks untuk pencarian IP individual
            $table->index('attack_ip');
            $table->index('target_ip');
            
            // Composite index untuk performa filter yang umum
            $table->index(['type', 'severity', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attack_logs');
    }
};