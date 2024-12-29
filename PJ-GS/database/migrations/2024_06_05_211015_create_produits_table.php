<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 100)->unique();
            $table->text('description');
            $table->decimal('prix_unitaire', 10, 2);
            $table->integer('quantite');
            $table->string('categorie', 100);
            $table->date('DateEntree');
            $table->date('DateFabrication');
            $table->enum('status', ['Disponible', 'Indisponible'])->default('Disponible');
            $table->foreign('nom')->references('produit_nom')->on('achats')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
}

