<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMovementsTable extends Migration
{
    public function up()
    {
        Schema::create('product_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('remark')->nullable();
            $table->datetime('record_in_at');
            $table->datetime('record_out_at')->nullable();
            $table->datetime('finish_at')->nullable();
            $table->string('previous_record')->nullable();
            $table->timestamps();
            // $table->softDeletes();
        });
    }
}
