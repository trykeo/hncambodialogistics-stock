<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country');
            $table->string('name')->unique();
            $table->string('address');
            $table->string('code')->unique();
            $table->longText('remark')->nullable();
            $table->timestamps();
            // $table->softDeletes();
        });
    }
}
