<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $articles = Article::query()->where('is_active', true)->get()->toArray();

        return apiResponse($articles);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse($article->toArray());
    }
}
