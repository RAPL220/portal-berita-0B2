<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom baru sementara
        Schema::table('articles_news', function (Blueprint $table) {
            $table->boolean('is_featured_temp')
                ->default(false)
                ->after('is_featured');
        });

        // 2. Convert data enum -> boolean
        DB::table('articles_news')->update([
            'is_featured_temp' => DB::raw("CASE WHEN is_featured = 'yes' THEN 1 ELSE 0 END"),
        ]);

        // 3. Drop kolom lama
        Schema::table('articles_news', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });

        // 4. Rename kolom temp → is_featured
        Schema::table('articles_news', function (Blueprint $table) {
            $table->renameColumn('is_featured_temp', 'is_featured');
        });
    }

    public function down(): void
    {
        // rollback ke enum
        Schema::table('articles_news', function (Blueprint $table) {
            $table->enum('is_featured_temp', ['yes', 'no'])
                ->default('no')
                ->after('is_featured');
        });

        DB::table('articles_news')->update([
            'is_featured_temp' => DB::raw("CASE WHEN is_featured = 1 THEN 'yes' ELSE 'no' END"),
        ]);

        Schema::table('articles_news', function (Blueprint $table) {
            $table->dropColumn('is_featured');
            $table->renameColumn('is_featured_temp', 'is_featured');
        });
    }
};
