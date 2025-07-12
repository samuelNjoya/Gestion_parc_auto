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
        Schema::create('panne', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('conducteur_id')->unsigned()->nullable();
            $table->tinyInteger('affectation_id')->unsigned();
            $table->string('type');
            $table->text('description');
            $table->date('date_panne')->nullable();
            $table->string('photo')->nullable();
            $table->string('localisation');
            $table->tinyInteger('statut')->default(1)->comment('1:attente,0:resolut');
            $table->integer('kilometrage_panne');
            $table->tinyInteger('is_delete')->default(0)->comment('0:no,1:yes');
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panne');
    }
};
