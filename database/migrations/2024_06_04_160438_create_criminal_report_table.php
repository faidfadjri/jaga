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
        Schema::create('criminal_report', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('reportBy');
            $table->foreign('reportBy')->references('id')->on('users');

            $table->string('crimeType');
            $table->text('description');

            $table->dateTime('date');
            $table->string('location');

            $table->boolean('verified')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_report');
    }
};
