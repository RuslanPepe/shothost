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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->json('paths');
            $table->unsignedSmallInteger('lifetime');
            $table->enum('access', ['link', 'password', 'private'])->default('link');
            $table->unsignedSmallInteger('deleteAfter');
            $table->enum('typeAccess', ['onlyView', 'all'])->default('onlyView');
            $table->string('Title', 255)->nullable();
            $table->string('Description', 1024)->nullable();
            $table->string('CustomLink', 255)->nullable()->unique();
            $table->string('password')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamp('expires_at')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
