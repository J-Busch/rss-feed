<?php

namespace App\Models;

use \Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Feed;

class Article extends Model
{
    protected $guarded = [];

    public static function getUserArticles(User $user, string $sortby)
    {
        $result = [];
        foreach ($user->feeds as $feed) {
            foreach ($feed->articles()->get() as $article) {
                array_push($result, $article);
            }
        }

        if ($sortby == 'pub_date') {
            usort($result, fn ($a, $b) => strtotime($b->pub_date) - strtotime($a->pub_date));
        }
        if ($sortby == 'title') {
            usort($result, fn ($a, $b) => strcasecmp($a->title, $b->title));
        }

        return $result;
    }

    public function feeds()
    {
        return $this->belongsTo(Feed::class);
    }
}
