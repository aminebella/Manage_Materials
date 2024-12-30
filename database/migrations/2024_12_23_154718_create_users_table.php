<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');//->default(1)
            $table->string('firstname');//First one: no user,not affected yet
            $table->string('lastname');
            $table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->unsignedBigInteger('sector_id');//->default(1);
            $table->foreign('sector_id')->references('id_sector')->on('sectors')->onUpdate('cascade');//->onDelete('set default')

            $table->enum('role', ['admin', 'user'])->default('user');
            $table->rememberToken(); // For authentication sessions
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

