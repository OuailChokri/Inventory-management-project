<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 100)->unique();
            $table->string('adresse', 255);
            $table->string('téléphone', 20);
            $table->string('email', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
