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
        Schema::create('document_vehicule', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('vehicule_id')->unsigned();
            $table->integer('created_by_id')->unsigned();
            $table->string('type');
            $table->date('date_derniere_mise_ajour')->nullable();
            $table->date('date_expiration')->nullable();
            $table->string('pdf_scan')->nullable();
            $table->integer('statut')->default(1)->comment('1:valide,0:expirer');
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
        Schema::dropIfExists('document_vehicule');
    }
};
