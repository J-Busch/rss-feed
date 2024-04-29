<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Feed;
use \Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = Auth::user()->feeds;
        return view('feedList', ['feeds' => $feeds]);
    }

    public function store()
    {
        request()->validate([
            'url' => 'required|url'
        ]);
        $url = request('url');

        Feed::importFeed($url);

        return redirect('/feed');
    }

    public function destroy()
    {
        request()->validate([
            'feedId' => 'required|integer'
        ]);
        $id = request('feedId');

        Feed::deleteFeed($id);

        return redirect('/feed');
    }
}
