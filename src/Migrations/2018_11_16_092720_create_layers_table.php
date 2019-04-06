<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('layers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 36);
            $table->string('name', 70)->nullable();
            $table->nullableMorphs('linkable');
            $table->string('locale', 10)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('position')->default(0);
            $table->string('template', 70)->default('default');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('layers');
    }
}
