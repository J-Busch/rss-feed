<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
use \App\Models\User;
use \App\Models\Article;

class Feed extends Model
{
  protected $fillable = ['title', 'url'];

  public static function importFeed(string $url)
  {
    // GET DATA
    if (@file_get_contents($url)) {
      $feedData = simplexml_load_file(rawurlencode($url));
      $title = $feedData->channel->title;
      $items = [];

      foreach ($feedData->channel->item as $item) {
        if ($item->children('media', true)->thumbnail) {
          $item['image'] = $item->children('media', true)->thumbnail->attributes()->url;
        } else {
          $item['image'] = '';
        }
        array_push($items, $item);
      }

      // CREATE FEED AND ARTICLES
      if (!static::where('url', $url)->count()) {
        $feed = static::create([
          'title' => $title,
          'url' => $url
        ]);

        foreach ($items as $item) {
          Article::create([
            'title' => $item->title,
            'description' => strip_tags($item->description),
            'link' => $item->link,
            'image' => $item->attributes()->image,
            'pub_date' => $item->pubDate,
            'feed_id' => $feed->id
          ]);
        }
      } else {
        $feed = static::where('url', $url)->first();
      }
    }

    // FEED_USER ENTRY
    if (!DB::table('feed_user')->where('feed_id', $feed->id)->where('user_id', Auth::user()->id)->count()) {
      $feed->users()->attach(Auth::user()->id);
    }
  }

  public static function deleteFeed(int $id)
  {
    $feed = static::findOrFail($id);
    $feed->users()->detach(Auth::user()->id);
    if (!DB::table('feed_user')->where('feed_id', $id)->count()) {
      $feed->delete();
    }
  }

  public function users()
  {
    return $this->belongsToMany(User::class);
  }

  public function articles()
  {
    return $this->hasMany(Article::class);
  }
}
