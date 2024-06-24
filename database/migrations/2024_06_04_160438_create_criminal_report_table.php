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

        DB::table('criminal_report')->insert(
            array(
            'reportBy' => '1',
            'crimeType' => 'Penipuan',
            'description' => 'bilang pity udah 30 tapi 20 pull belum dapet SSR',
            'location' => 'Jakarta Pusat, Jl Indah Sekali Sebelah Indomaret, No 12451',
            'date' => date("Y-m-d H:i:s") 
            )
        );

        
        DB::table('criminal_report')->insert(
            array(
            'reportBy' => '1',
            'crimeType' => 'Penipuan',
            'description' => 'Mie ayam tapi gada mienya, cuman bihun',
            'location' => 'Jakarta Pusat, Jl Elok Sangad Sebelah Alfamart, No 14045',
            'verified' => true,
            'date' => date("Y-m-d H:i:s")
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('criminal_report', function($table)
        {
            $table->dropForeign('reportBy');
            $table->foreign('reportBy')->references('id')->on('users');
        });

        Schema::dropIfExists('criminal_report');
    }
};
