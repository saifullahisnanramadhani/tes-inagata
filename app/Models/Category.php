<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi:
     * Satu kategori memiliki banyak artikel
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}