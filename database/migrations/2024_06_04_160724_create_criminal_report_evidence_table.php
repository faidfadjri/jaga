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
        Schema::create('criminal_report_evidence', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('reportId');
            $table->foreign('reportId')->references('id')->on('criminal_report');

            $table->string('fileName');
            $table->string('fileType')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_report_evidence');
    }
};
