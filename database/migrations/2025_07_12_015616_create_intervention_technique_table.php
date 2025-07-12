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
        Schema::create('intervention_technique', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicule_id')->unsigned();
            $table->integer('created_by_id')->unsigned()->nullable();
            $table->string('type');
            $table->string('titre');
            $table->date('date');
            $table->decimal('cout', 10, 0);
            $table->string('description');
            $table->integer('kilometrage');
            $table->tinyInteger('fournisseur_id')->unsigned();
            $table->date('prochaine_date')->nullable();
            $table->string('frequence')->nullable();
            $table->integer('duree_imobilisation')->nullable();
            $table->tinyInteger('is_delete')->default(0)->comment('0:no,1:yes');
            $table->date('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervention_technique');
    }
};
