<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 255)->nullable();
            $table->unsignedSmallInteger('address_id')->length(5);
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone', 13)->nullable();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('address_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('address_id');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('phone');
        });
    }
}
