<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['subject', 'slug', 'body'];

    protected $searchableFields = ['*'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function articleLikes()
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function articleViews()
    {
        return $this->hasMany(ArticleView::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
