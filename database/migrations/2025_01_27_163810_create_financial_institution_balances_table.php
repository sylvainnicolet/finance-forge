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
        Schema::create('financial_institution_balances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('financial_institution_id')->constrained()->onDelete('cascade');
            $table->integer('balance');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_institution_balances');
    }
};
