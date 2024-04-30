<?php

namespace App\Models;

use \Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use \Illuminate\Support\Facades\DB;
use \App\Models\Feed;

class Article extends Model
{
    protected $guarded = [];

    public static function getUserArticles(User $user, string $sortby, string $sortorder)
    {
        $feedIds = [];
        foreach ($user->feeds as $feed) {
            array_push($feedIds, $feed->id);
        }

        $articles = Article::whereIn('feed_id', $feedIds)->orderBy($sortby, $sortorder)->paginate(10);

        return $articles;
    }

    public function feeds()
    {
        return $this->belongsTo(Feed::class);
    }
}
