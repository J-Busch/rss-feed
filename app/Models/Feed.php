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
    libxml_use_internal_errors(true);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $feedData = simplexml_load_string($response);

    if ($feedData) {
      $title = $feedData->channel->title ?: '';

      if ($title && $feedData->channel->link) {
        $items = [];
        foreach ($feedData->channel->item as $item) {
          if ($item->children('media', true)->thumbnail) {
            $item['image'] = $item->children('media', true)->thumbnail->attributes()->url;
          } elseif ($item->children('media', true)->content) {
            $item['image'] = $item->children('media', true)->content->attributes()->url;
          } else {
            $item['image'] = null;
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
              'pub_date' => $item->pubDate ?: null,
              'feed_id' => $feed->id
            ]);
          }
        } else {
          $feed = static::where('url', $url)->first();
        }

        // SUBSCRIBE THE USER
        if (!DB::table('feed_user')->where('feed_id', $feed->id)->where('user_id', Auth::user()->id)->count()) {
          $feed->users()->attach(Auth::user()->id);
        }
      } else {
        return back()->withErrors(['url' => 'Must be a valid RSS feed.']);
      }
    } else {
      return back()->withErrors(['url' => 'Response must be valid XML.']);
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
    return $this->belongsToMany(User::class)->withPivot('feed_id');
  }

  public function articles()
  {
    return $this->hasMany(Article::class);
  }
}
