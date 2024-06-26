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
        Schema::create('criminal_records', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

            $table->enum('crimeType', ['Penipuan', 'Narkotika', 'Penganiayaan', 'Lainya'])->default('Lainya');
            $table->text('description');

            $table->dateTime('date');
            $table->string('location');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_records');
    }
};
