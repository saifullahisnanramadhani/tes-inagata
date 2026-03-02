<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        // Ambil semua data kategori
        $categories = Category::all();

        // Return dalam format JSON
        return response()->json([
            'status' => true,
            'message' => 'List of categories',
            'data' => $categories
        ]);
    }

    /**
     * Menyimpan kategori baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Simpan ke database (mass assignment)
        $category = Category::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }
}