<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laramate\StructuredDocument\ValueObjects\BlockStatus;
use Laramate\StructuredDocument\ValueObjects\ContentType;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 36);
            $table->nullableMorphs('linkable');
            $table->string('locale', 10)->nullable();
            $table->string('name', 0)->nullable();
            $table->string('type', 10)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('position')->default(0);
            $table->string('template', 70)->default('default');
            $table->tinyInteger('heading_order')->default(1);
            $table->string('content_type', 20)->nullable();
            $table->dateTime('published_at')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
