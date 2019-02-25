<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('order_film', function (Blueprint $table) {
            $table->unsignedSmallInteger('order_id')->length(5);
            $table->unsignedSmallInteger('film_id')->length(5);
        
        //indexes
        $table->primary(['order_id', 'film_id']);
        
        //relations
        $table->foreign('film_id')
            ->references('film_id')
            ->on('film')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        
        $table->foreign('order_id')
            ->references('order_id')
            ->on('order')
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
        Schema::dropIfExists('order_film');
    }
}
