<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleView extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['article_id', 'view'];

    protected $searchableFields = ['*'];

    protected $table = 'article_views';

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
