<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/* published_at fillable only use blog **/
class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'is_published',
        'published_at',
        'slug',
        'author_id',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'array',
    ];


    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeDraft(Builder $query)
    {
        return $query->whereNull('published_at');
    }
    
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
}
