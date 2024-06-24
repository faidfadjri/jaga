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
        Schema::create('criminal_report_news', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('reportId');
            $table->foreign('reportId')->references('id')->on('criminal_report');

            $table->string('fileName');
            $table->string('fileType')->nullable();

            $table->timestamps();
        });

        DB::table('criminal_report_news')->insert(
            array(
            'reportId' => '1',
            'fileName' => '..\public\assets\crime\proof1.jpg'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('criminal_report_news', function($table)
        {
            $table->dropForeign('reportId');
            $table->foreign('reportId')->references('id')->on('criminal_report');
        });

        Schema::dropIfExists('criminal_report_news');
    }
};
