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
        Schema::create('affectation_vehecule', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('conducteur_id')->unsigned();
            $table->tinyInteger('vehicule_id')->unsigned();
            $table->string('description')->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->tinyInteger('statut')->default(1)->comment('0:inactive;1:active');
            $table->tinyInteger('is_delete')->default(0)->comment('0:no,1:yes');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectation_vehicule');
    }
};
