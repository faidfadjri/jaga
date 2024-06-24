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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username');
            $table->string('fullName');
            $table->string('NIK')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('role', ['user', 'admin']);
            $table->string('password');

            $table->boolean('isEmailVerified')->default(false);
            $table->boolean('isNIKVerified')->default(false);
            $table->timestamps();

            
        });

        DB::table('users')->insert(
            array(
            'username' => 'admin-service',
            'fullName' => 'ngeri admin',
            'phone' => '081769696969',
            'email' => 'admin@local',
            'address' => 'Jakarta Pusat, Jl Indah Sekali Sebelah Indomaret, No 12451',
            'role' => 'admin',
            'password' => $password = Hash::make('1234')
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
