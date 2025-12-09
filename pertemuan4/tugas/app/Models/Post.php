<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['Author', 'Category'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    /**
     * Query Scope: Filter pencarian berdasarkan search, category, atau author.
     *
     * @param Builder $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where('title', 'like', '%' . $search . '%')
        );

        $query->when($filters['category'] ?? false,
            fn($query, $category) => $query->whereHas('category', fn($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false,
            fn($query, $author) => $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
