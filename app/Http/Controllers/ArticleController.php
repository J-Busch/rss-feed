<?php

namespace App\Http\Controllers;

use \App\Models\Article;
use \Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $sortby = request()->sortby ?? 'pub_date';
        $sortorder = request('sortorder') ?: 'desc';
        $articles = Article::getUserArticles(Auth::user(), $sortby, $sortorder);

        return view('articles', ['articles' => $articles, 'sortby' => $sortby, 'sortorder' => $sortorder]);
    }
}
