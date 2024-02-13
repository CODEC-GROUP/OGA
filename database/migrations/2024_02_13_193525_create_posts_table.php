<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('type'); // 'Project', 'Blog', or 'Event'
            $table->json('statistics')->nullable(); // For Project statistics
            $table->date('event_date')->nullable(); // For Event date
            $table->time('event_time')->nullable(); // For Event time
            $table->foreignId('category_id')->nullable()->constrained('project_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
