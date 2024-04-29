<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \App\Models\User;

class Feed extends Model
{
  protected $fillable = ['title', 'url'];

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
