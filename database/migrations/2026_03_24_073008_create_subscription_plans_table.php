<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->decimal('price', 10, 2)->default(0);

            $table->integer('duration_days');
            $table->text('description')->nullable();

            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index('status');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};