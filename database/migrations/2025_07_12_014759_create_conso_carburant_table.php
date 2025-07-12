<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('conso_carburant', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('created_by_id')->unsigned();
            $table->integer('vehicule_id')->unsigned();
            $table->date('date_conso');
            $table->integer('quantite_conso');
            $table->decimal('cout_conso', 10, 0);
            $table->integer('kilometrage_plein');
            $table->string('note')->nullable();
            $table->integer('fournisseur_id')->unsigned();
            $table->tinyInteger('is_delete')->default(0)->comment('0:no,1:yes');
            $table->date('created_at');
            $table->dateTime('updated_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('conso_carburant');
    }
};
