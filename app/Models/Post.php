<?php

namespace App\Models;

use App\Mail\PostStored;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    // protected static function booted()
    // {
    //     static::created(function ($post) {
    //         Mail::to('tester@gmail.com')->send(new PostStored($post));
    //     });
    // }
}
