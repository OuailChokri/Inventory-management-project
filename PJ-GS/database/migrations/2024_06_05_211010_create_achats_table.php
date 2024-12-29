<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatsTable extends Migration
{
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fournisseur_nom',100);
            $table->string('produit_nom',100)->unique();
            $table->integer('quantite');
            $table->integer('quantiteAvantAjouter')->nullable();
            $table->decimal('prix', 10, 2);
            $table->date('date_achat');

            $table->foreign('fournisseur_nom')->references('nom')->on('fournisseurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('achats');
    }
}

