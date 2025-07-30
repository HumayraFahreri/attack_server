<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
    Schema::create('attack_servers', function (Blueprint $table) {
        $table->id();
        $table->string('nama_serangan');
        $table->string('dos_type');           // TCP_Flood, ICMP_Flood, UDP_Flood
        $table->string('source_server');      // zeus, posseidon, dll
        $table->string('ip_target');          // e.g. 192.168.1.1
        $table->integer('port');              // e.g. 80
        $table->integer('durasi');            // dalam detik
        $table->integer('data_size'); // dalam MB
        $table->enum('status', ['Pending', 'Completed', 'Failed'])->default('Pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attack_servers');
    }
};
