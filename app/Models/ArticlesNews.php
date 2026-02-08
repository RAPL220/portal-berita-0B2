<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesNews extends Model
{
    protected $table = 'articles_news';

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'is_featured' => 'boolean',
        'views',
    ];

    public function category()
    {
        // harus di tentukan kalau tidak dia buat id_category
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
