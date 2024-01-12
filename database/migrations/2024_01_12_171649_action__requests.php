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
        Schema::create('action_requests', function (Blueprint $table) {
                    $table->id();
                    $table->timestamps();

                    $table->foreignId('action_id')
                         ->constrained()
                         ->onUpdate('cascade')
                         ->onDelete('cascade');


                    $table->foreignId('request_id')
                       ->constrained()
                       ->onUpdate('cascade')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
