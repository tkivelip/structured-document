<?php

use Laramate\StructuredDocument\ValueObjects\DocumentStatus;
use Laramate\StructuredDocument\ValueObjects\DocumentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 36);
            $table->string('locale', 10)->nullable();
            $table->string('slug')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('type', 10)->default(DocumentType::Content);
            $table->tinyInteger('status')->default(DocumentStatus::Active);
            $table->integer('order')->default(0);
            $table->json('config')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}