<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('article_category')) {
            Schema::create('article_category', function (Blueprint $table) {
                $table->id();

                $table->foreignId('article_id')
                    ->constrained('articles')
                    ->cascadeOnDelete();

                $table->foreignId('category_id')
                    ->constrained('categories')
                    ->cascadeOnDelete();

                $table->timestamps();

                $table->unique(['article_id', 'category_id']);
            });
        }

        // Backfill existing category_id from articles table
        $existing = DB::table('articles')
            ->whereNotNull('category_id')
            ->where('category_id', '>', 0)
            ->select('id as article_id', 'category_id')
            ->get();

        $now = now();
        $records = [];
        foreach ($existing as $row) {
            $catExists = DB::table('categories')->where('id', $row->category_id)->exists();
            if ($catExists) {
                $records[] = [
                    'article_id' => $row->article_id,
                    'category_id' => $row->category_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        if (!empty($records)) {
            DB::table('article_category')->insertOrIgnore($records);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('article_category');
    }
};
