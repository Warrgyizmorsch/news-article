<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('subscription_plan_id')
                ->constrained('subscription_plans')
                ->cascadeOnDelete();

            $table->date('start_date');
            $table->date('end_date');

            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])
                ->default('pending');

            $table->string('payment_status')->nullable(); // future use
            $table->string('payment_reference')->nullable(); // future use

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('end_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};