<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->smallIncrements('order_id')->length(5);
            $table->unsignedInteger('user_id')->length(10);
            $table->timestamp('created')->useCurrent();
            $table->unsignedSmallInteger('status')->length(5);
        
        //indexes
        $table->index('status', 'fk_status_idx');
        $table->index('user_id', 'order_user_id_idx');
        
        //relations
        $table->foreign('status')
            ->references('id')
            ->on('dct_order_status')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        
        $table->foreign('user_id')
            ->references('id')
            ->on('users');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
