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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('action_time');
            $table->timestamps();

            $table->foreignId('request_id')
                ->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreignId('type_id')
                ->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};