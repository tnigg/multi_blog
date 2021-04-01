<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'body', 'featured_image', 'slug', 'meta_title', 'meta_description'];

    public function category() {
        return $this->belongsToMany(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
