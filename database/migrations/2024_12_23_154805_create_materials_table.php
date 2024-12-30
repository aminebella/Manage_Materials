<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id('id_material');

            $table->unsignedBigInteger('type_id');//->default(1)
            $table->foreign('type_id')->references('id_type')->on('types')->onUpdate('cascade');//->onDelete('set default')

            $table->unsignedBigInteger('brand_id');//->default(1)
            $table->foreign('brand_id')->references('id_brand')->on('brands')->onUpdate('cascade');//->onDelete('set default')

            $table->string('name'); //no material ,not affected yet
            $table->enum('status', ['libre', 'occupé', 'en maintenance', 'réparé']);

            $table->unsignedBigInteger('user_id');//->default(1)
            $table->foreign('user_id')->references('id_user')->on('users')->onUpdate('cascade');//->onDelete('set default')
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
}

