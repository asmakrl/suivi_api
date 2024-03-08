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
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->date('received_at');
            $table->enum('status', ['على قيد الدراسة', 'مغلق'])->default('على قيد الدراسة');
           // $table->string('status')->default('على قيد الدراسة');
            $table->timestamps();

            $table->foreignId('sender_id')
                ->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');

           $table->foreignId('state_id')
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
        Schema::dropIfExists('requests');
    }
};
