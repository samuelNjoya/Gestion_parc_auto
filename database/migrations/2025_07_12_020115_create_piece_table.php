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
        Schema::create('piece', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('intervention_id')->unsigned();
            $table->string('nom');
            $table->string('reference');
            $table->date('date_installation');
            $table->date('date_expiration')->nullable();
            $table->decimal('cout_unitaire', 10, 0);
            $table->integer('quantite')->nullable();
            $table->bigInteger('kilometrage_installation')->nullable();
            $table->string('duree_vie')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('statut')->default(1)->comment('1:actif,0:inactif');
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
        Schema::dropIfExists('piece');
    }
};
