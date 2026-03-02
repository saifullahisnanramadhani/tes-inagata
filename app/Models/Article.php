<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'title',
        'content',
        'author',
        'category_id',
    ];

    /**
     * Relasi:
     * Satu artikel dimiliki oleh satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}