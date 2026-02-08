<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration

{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW vw_category_stats AS
            SELECT
                c.id AS category_id,
                c.title AS category_name,
                COUNT(a.id) AS total_articles,
                COALESCE(SUM(a.views), 0) AS total_views,
                SUM(
                    CASE 
                        WHEN a.is_featured = 'yes' THEN 1 
                        ELSE 0 
                    END
                ) AS total_featured
            FROM categories c
            LEFT JOIN articles_news a 
                ON a.category_id = c.id
            GROUP BY c.id, c.title
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_category_stats');
    }
};
