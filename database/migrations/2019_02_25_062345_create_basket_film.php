<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_film', function (Blueprint $table) {
            $table->unsignedSmallInteger('film_id')->length(5);
            $table->unsignedSmallInteger('basket_id')->length(5);
        
        //indexes
        $table->primary(['film_id', 'basket_id']);
        
        //relations
        $table->foreign('basket_id')
            ->references('basket_id')
            ->on('basket')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        
        $table->foreign('film_id')
            ->references('film_id')
            ->on('film')
            ->onUpdate('cascade')
            ->onDelete('restrict');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basket_film');
    }
}
