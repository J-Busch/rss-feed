<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Feed;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = Auth::user()->feeds;

        $feedsWithData = [];
        foreach ($feeds as $feed) {
            if (@file_get_contents($feed->url)) {
                $feedData = simplexml_load_file(rawurlencode($feed->url));
                foreach ($feedData->channel->item as $item) {
                    if ($item->children('media', true)->thumbnail) {
                        $item['img'] = $item->children('media', true)->thumbnail->attributes()->url;
                    }
                }
                array_push($feedsWithData, $feedData);
            }
        }

        return view('feed', ['feeds' => $feedsWithData]);
    }

    public function list()
    {
        $feeds = Auth::user()->feeds;

        $listData = [];
        foreach ($feeds as $feed) {
            if (@file_get_contents($feed->url)) {
                $feedData = simplexml_load_file(rawurlencode($feed->url));
                array_push($listData, [
                    'id' => $feed->id,
                    'title' => $feedData->channel->title,
                    'url' => $feed->url
                ]);
            }
        }

        return view('list', ['list' => $listData]);
    }

    public function store()
    {
        request()->validate([
            'url' => 'required|url'
        ]);

        $url = request('url');

        if (@file_get_contents($url)) {
            $feedData = simplexml_load_file(rawurlencode($url));
            $title = $feedData->channel->title;
        }

        if (!Feed::where('url', $url)->count()) {
            $feed = Feed::create([
                'title' => $title,
                'url' => $url
            ]);
        } else {
            $feed = Feed::where('url', $url)->first();
        }

        $feed->users()->attach(Auth::user()->id);

        return redirect('/feed/list');
    }

    public function destroy()
    {
        request()->validate([
            'feedId' => 'required|integer'
        ]);

        $id = request('feedId');
        $feed = Feed::findOrFail($id);
        $feed->users()->detach(Auth::user()->id);
        if (!DB::table('feed_user')->where('feed_id', $id)->count()) {
            $feed->delete();
        }

        return redirect('/feed/list');
    }
}
