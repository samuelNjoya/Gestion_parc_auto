<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->tinyInteger('created_by_id')->unsigned()->nullable();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->date('date_naiss')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('num_permis')->nullable();
            $table->char('type_permis', 2)->nullable();
            $table->date('date_exp_permis')->nullable();
            $table->string('formation')->nullable();
            $table->string('profile_pic')->nullable();
            $table->tinyInteger('role')->comment('1:admin, 2:gestionnaire, 3:comptable, 4:conducteur, 5:fournisseur');
            $table->tinyInteger('statut')->default(1)->comment('0:inactive,1:active');
            $table->tinyInteger('is_delete')->default(0)->comment('0:no,1:yes');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
