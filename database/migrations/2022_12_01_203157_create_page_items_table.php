<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('page_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('page_items')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('uuid')->nullable();
            $table->string('type')->nullable();
            $table->integer('weight')->nullable();
            $table->string('image_id')->nullable();
            $table->string('response_type')->nullable();
            $table->string('response_set')->nullable();
            $table->boolean('multiple_selection')->nullable()->default(false);
            $table->json('check_conditions_for')->nullable();
            $table->json('categories')->nullable();
            $table->boolean('is_required')->nullable()->default(true);
            $table->boolean('is_negative')->nullable()->default(false);
            $table->boolean('is_notes_allowed')->nullable()->default(false);
            $table->boolean('is_photos_allowed')->nullable()->default(false);
            $table->boolean('is_issues_allowed')->nullable()->default(false);
            $table->boolean('is_responded')->nullable()->default(false);
            $table->boolean('is_repeat')->nullable()->default(false);
            $table->string('value')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_items');
    }
};
