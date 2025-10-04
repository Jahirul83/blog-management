<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Blog extends Model
{
    protected $fillable = [
        'title','slug','category_id','operator_id','description','thumbnail','status'
    ];

    public function category() {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function operator() {
        return $this->belongsTo(User::class, 'operator_id');
    }

    // auto-generate slug on create
    protected static function booted() {
        static::creating(function ($blog) {
            $slug = Str::slug($blog->title);
            $original = $slug;
            $i = 1;
            while (static::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i++;
            }
            $blog->slug = $slug;
        });
    }
}

