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
        // 'category_id' adalah foreign key di tabel posts
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
        // Filter berdasarkan judul (search)
        // Menggunakan "when" agar hanya dieksekusi jika $filters['search'] tidak kosong/false
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where('title', 'like', '%' . $search . '%')
        );

        // Filter berdasarkan slug category
        // Menggunakan whereHas untuk menyeleksi Post yang memiliki Category dengan slug tertentu
        $query->when($filters['category'] ?? false,
            fn($query, $category) => $query->whereHas('category', fn($query) =>
                $query->where('slug', $category)
            )
        );

        // Filter berdasarkan username author (di sini diasumsikan ada relasi 'author' ke User)
        // Menggunakan whereHas untuk menyeleksi Post yang memiliki Author dengan username tertentu
        $query->when($filters['author'] ?? false,
            fn($query, $author) => $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );
    }
}
