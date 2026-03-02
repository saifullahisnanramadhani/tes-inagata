<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Menampilkan daftar artikel dengan pagination
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);

        $articles = Article::with('category')->paginate($limit);

        return response()->json([
            'status'  => true,
            'message' => 'List of articles',
            'data'    => $articles
        ]);
    }

    /**
     * Menyimpan artikel baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'author'      => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $article = Article::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Article created successfully',
            'data'    => $article
        ], 201);
    }

    /**
     * Menampilkan detail artikel berdasarkan ID
     */
    public function show($id)
    {
        $article = Article::with('category')->findOrFail($id);

        return response()->json([
            'status'  => true,
            'message' => 'Article detail',
            'data'    => $article
        ]);
    }

    /**
     * Update artikel berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'content'     => 'sometimes|required|string',
            'author'      => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id'
        ]);

        $article->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Article updated successfully',
            'data'    => $article
        ]);
    }

    /**
     * Menghapus artikel berdasarkan ID
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Article deleted successfully'
        ]);
    }

    /**
     * Search artikel dengan filter lanjutan
     */
    public function search(Request $request)
    {
        $query = Article::with('category');

        // 🔎 Filter berdasarkan category_id
        if ($request->input('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // 🔎 Filter berdasarkan keyword di title
        if ($request->input('keyword')) {
            $query->where('title', 'like', '%' . $request->input('keyword') . '%');
        }

        // 🔎 Filter berdasarkan keyword di content
        if ($request->input('content')) {
            $query->where('content', 'like', '%' . $request->input('content') . '%');
        }

        // 📅 Filter berdasarkan satu tanggal
        if ($request->input('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // 📅 Filter berdasarkan rentang tanggal
        if ($request->input('start_date') && $request->input('end_date')) {
            $query->whereBetween('created_at', [
                $request->input('start_date'),
                $request->input('end_date')
            ]);
        }

        // 🔽 Optional: sorting terbaru/terlama
        if ($request->input('sort') === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // default terbaru
        }

        $articles = $query->paginate(10);

        return response()->json([
            'status'  => true,
            'message' => 'Search result',
            'data'    => $articles
        ]);
    }
}