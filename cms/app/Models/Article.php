<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Illuminate\Support\Str;

class Article extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;

    protected $fillable = [
        'title',
        'article_category_id',
        'published_at',
        'summary',
        'content',
        'image',
        'user_id',
        'views'
    ];

    // An article belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An article belongs to a (article) category.
    public function article_category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    // Upload the image when it's set.
    public function setImageAttribute($value)
    {
        $this->uploadFileToDisk($value, 'image', 'public', 'uploads/articles');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function($article) {
            // Automatically set the user ID when creating an article in the dashboard.
            if(backpack_user()) {
                $article->user_id = backpack_user()->id;
            }

            // Automatically set the summary if empty (by taking the first 150 characters of the content).
            if(empty($article->summary)) {
                // Remove spaces, line breaks, HTML tags, decode HTML entities (fixes special characters).
                $cleanContent = html_entity_decode(strip_tags(str_replace("\r\n", '', trim($article->content))));
                $article->summary = Str::limit(strip_tags($cleanContent), 150);
            }

            $article->save();
        });
    }

    // Automatically generate a slug from the title attribute.
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
