<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewCategoryStat extends Model
{
    protected $table = 'vw_category_stats';

    protected $primaryKey = 'category_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'category_name',
        'total_articles',
        'total_views',
        'total_featured',
    ];


    protected static function booted()
    {
        static::creating(fn() => false);
        static::updating(fn() => false);
        static::deleting(fn() => false);
    }
}
