<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bar_code')->unique();
            $table->string('group')->nullable();
            $table->datetime('deliver_at')->nullable();
            $table->longText('remark')->nullable();
            $table->boolean('is_group')->default(0)->nullable();
            $table->timestamps();
            // $table->softDeletes();
        });
    }
}
