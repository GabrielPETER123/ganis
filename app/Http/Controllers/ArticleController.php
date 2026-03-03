<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        $selectedCategory = trim((string) $request->query('category', ''));

        if ($selectedCategory !== '') {
            $query->whereRaw('LOWER(TRIM(category)) = ?', [mb_strtolower($selectedCategory)]);
        }

        $articles = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Article::query()
            ->whereNotNull('category')
            ->pluck('category')
            ->map(fn ($category) => trim((string) $category))
            ->filter(fn ($category) => $category !== '')
            ->unique()
            ->sort()
            ->values();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function create() { }
    public function store(Request $request) { }
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
    public function edit(Article $article) { }
    public function update(Request $request, Article $article) { }
    public function destroy(Article $article) { }
}