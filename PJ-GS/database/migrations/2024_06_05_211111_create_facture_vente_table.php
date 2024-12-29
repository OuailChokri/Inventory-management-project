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
        Schema::create('facture_vente', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('facture_id');
            $table->unsignedInteger('vente_id');
            $table->timestamps();
        
            $table->foreign('facture_id')->references('id')->on('factures')->onDelete('cascade');
            $table->foreign('vente_id')->references('id')->on('ventes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facture_vente');
    }
};