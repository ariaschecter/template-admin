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
        Schema::create('iku_5', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('nip')->nullable();
            // $table->foreignUuid('select_id')->nullable();
            $table->string('activity_type')->nullable();
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iku_5');
    }
};
