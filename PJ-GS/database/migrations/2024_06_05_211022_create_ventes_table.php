<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_nom', 100);
            $table->string('produit_nom', 100);
            $table->integer('quantite');
            $table->integer('prix');
            $table->date('date_vente');
            $table->foreign('client_nom')->references('nom')->on('clients')->onDelete('cascade');
            $table->foreign('produit_nom')->references('nom')->on('produits')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
