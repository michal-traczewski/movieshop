<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film', function (Blueprint $table) {
            $table->smallIncrements('film_id');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->year('release_year')->nullable();
            $table->unsignedTinyInteger('language_id')->length(3);
            $table->unsignedTinyInteger('original_language_id')->length(3)->nullable();
            $table->unsignedTinyInteger('rental_duration')->length(3)->default(3);
            $table->decimal('rental_rate', 4, 2)->default(4.99);
            $table->decimal('price', 4, 2)->default(0.00);
            $table->unsignedSmallInteger('length')->length(5)->nullable();
            $table->decimal('replacement_cost', 5, 2)->default(19.99);
            $table->enum('rating', ['G', 'PG', 'PG-13', 'R', 'NC-17'])->default('G');
            $table->string('special_features', 255)->nullable();
            $table->timestamp('last_update')->useCurrent();
            
            //indexes
            $table->index('title', 'idx_title');
            $table->index('language_id', 'idx_fk_language_id');
            $table->index('original_language_id', 'idx_fk_original_language_id');
            $table->index('length', 'idx_length');
            
            //relations
            $table->foreign('language_id')
                    ->references('language_id')
                    ->on('language')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            
            $table->foreign('original_language_id')
                    ->references('language_id')
                    ->on('language')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film');
    }
}
