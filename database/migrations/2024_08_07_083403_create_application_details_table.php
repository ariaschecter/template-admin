<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('application_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('application_id')->constrained('applications');
            $table->string('nama', 100);
            $table->string('nik', 16);
            $table->date('tanggal_lahir');
            $table->enum('status_perkawinan', ['single', 'married']);
            $table->string('data_pasangan')->nullable();
            $table->string('dealer', 100);
            $table->string('merk_kendaraan', 100);
            $table->string('model_kendaraan', 100);
            $table->string('tipe_kendaraan', 100);
            $table->string('warna_kendaraan', 50);
            $table->decimal('harga_kendaraan', 15, 2);
            $table->decimal('asuransi', 15, 2);
            $table->decimal('down_payment', 15, 2);
            $table->integer('lama_kredit_bulan');
            $table->decimal('angsuran_bulan', 15, 2);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('application_details');
    }
};
