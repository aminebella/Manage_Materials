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
        Schema::create('requests', function (Blueprint $table) {
            $table->id('id_request');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('material_id');
            $table->enum('status', ['en attente', 'accepté', 'refusé'])->default('en attente');
            $table->timestamps();
            // $table->timestamp('date_request')->useCurrent();

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('material_id')->references('id_material')->on('materials')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
