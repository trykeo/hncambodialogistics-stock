<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductMovementsTable extends Migration
{
    public function up()
    {
        Schema::table('product_movements', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_8149905')->references('id')->on('products');
            $table->unsignedBigInteger('in_location_id')->nullable();
            $table->foreign('in_location_id', 'in_location_fk_8149907')->references('id')->on('locations');
            $table->unsignedBigInteger('record_in_by_id')->nullable();
            $table->foreign('record_in_by_id', 'record_in_by_fk_8149906')->references('id')->on('users');
            $table->unsignedBigInteger('out_location_id')->nullable();
            $table->foreign('out_location_id', 'out_location_fk_8149908')->references('id')->on('locations');
            $table->unsignedBigInteger('record_out_by_id')->nullable();
            $table->foreign('record_out_by_id', 'record_out_by_fk_8149911')->references('id')->on('users');
            $table->unsignedBigInteger('record_finish_by_id')->nullable();
            $table->foreign('record_finish_by_id', 'record_finish_by_fk_8149912')->references('id')->on('users');
        });
    }
}
