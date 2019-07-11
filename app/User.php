<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function favorite_posts() {
      return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'favorite_postid')->withTimestamps();
    }

    public function favorite($postId) {
      $exist = $this->is_favorite($postId);

      if ($exist) {
        return false;
      } else {
        $this->favorite_posts()->attach($postId);
        return true;
      }
    }

    public function unfavorite($postId) {
      $exist = $this->is_favorite($postId);

        if ($exist) {
          $this->favorite_posts()->detach($postId);
          return true;
        } else {
          return false;
        }
    }

    public function is_favorite($postId) {
      return $this->favorite_posts()->where('favorite_postid', $postId)->exists();
    }

}
