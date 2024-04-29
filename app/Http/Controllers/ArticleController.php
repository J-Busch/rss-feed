<?php

namespace App\Http\Controllers;

use \App\Models\Article;
use \Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $sortby = request()->sortby ?? '';
        $articles = Article::getUserArticles(Auth::user(), $sortby);

        return view('articles', ['articles' => $articles, 'sortby' => $sortby]);
    }
}
