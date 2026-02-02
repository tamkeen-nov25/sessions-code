<?php

namespace App\Models;

use App\Observers\Post11Observer;
use App\Observers\PostObserver;
use App\Policies\PostPolicy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(PostPolicy::class)]
#[ObservedBy(Post11Observer::class)]
class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'post_user');
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
}
