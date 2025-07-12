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
        Schema::create('vehicule', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('created_by_id')->unsigned();
            $table->string('immatriculation');
            $table->string('marque')->nullable();
            $table->string('modele');
            $table->string('photo')->nullable();
            $table->integer('kilometrage');
            $table->string('type_carburant')->nullable();
            $table->date('date_achat');
            $table->tinyInteger('statut')->default(1)->comment('1:active, 0:inactive');
            $table->string('departement')->nullable();
            $table->tinyInteger('is_delete')->default(0)->comment('0:no, 1:yes');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vehicule');
    }
};
