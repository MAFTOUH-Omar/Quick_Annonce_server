<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('telephone');
            $table->UnsignedBigInteger('categorie');
            $table->UnsignedBigInteger('ville');
            $table->text('titreAnnonce');
            $table->text('descriptionAnnonce');
            $table->float('prix');
            $table->string('photo');
            $table->UnsignedBigInteger('user_id');
            $table->boolean('validate')->default(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categorie')->references('id')->on('categories');
            $table->foreign('ville')->references('id')->on('villes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonces');
    }
}
