<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Illuminate\Support\Str;

class HomeBlock extends Model
{
    use CrudTrait;
    use UsesTenantConnection;

    protected $fillable = [
        'name',
        'block',
        'extras',
        'parent_id',
        'lft',
        'rgt',
        'depth'
    ];

    // Default values for reorder attributes.
    protected $attributes = [
        'parent_id' => 0,
        'lft' => 0,
        'rgt' => 0,
        'depth' => 0
    ];

    // Fake column for storing data from the block-specific fields.
    protected $fakeColumns = [
        'extras'
    ];

    protected $casts = [
        'extras' => 'array'
    ];

    // Custom mutator for the extras field which allows storing of images.
    public function setExtrasAttribute($newExtras)
    {
        // Get and parse the old extras field if we're updating.
        $oldExtras = isset($this->attributes['extras']) ? json_decode($this->attributes['extras'], true) : [];

        // Loop through the extras input.
        foreach($newExtras as $fieldName => $fieldValue) {
            if(Str::contains($fieldName, 'image')) {
                // If an image was previously uploaded, set it's filename to an attribute which will be detected by uploadFileToDisk, so the image can be deleted if needed.
                if(isset($oldExtras[$fieldName])) {
                    $this->attributes[$fieldName] = $oldExtras[$fieldName];
                }

                // Upload the image.
                $this->uploadFileToDisk($fieldValue, $fieldName, 'public', 'uploads/home');

                // If the upload was successful, get the filename from the attribute set by uploadFileToDisk, apply it to the extras array, and unset the original attribute.
                if(isset($this->attributes[$fieldName])) {
                    $newExtras[$fieldName] = $this->attributes[$fieldName];
                    unset($this->attributes[$fieldName]);
                }
            }
        }

        // Encode the edited extras field.
        $this->attributes['extras'] = json_encode($newExtras);
    }

    // Get all the home blocks along with required data.
    // For example, for an articles block, get the actual articles and append them.
    public static function getWithData()
    {
        // Get the blocks by their order.
        $blocks = self::orderBy('lft')->get();
        
        foreach($blocks as $block) {
            $appendExtra = [];

            switch($block->block) {
                // Fetch articles for chosen category.
                case 'articles':
                    $hideLatest = $block->extras['latest'] ?? false;
                    $categoryId = $block->extras['category_id'] ?? null;
                    $appendExtra['articles'] = Article::select('id', 'title', 'slug', 'summary', 'image', 'article_category_id', 'published_at')
                        ->with('article_category')
                        ->when($categoryId, fn($query) => $query->where('article_category_id', $categoryId))
                        ->where('published_at', '<=', \Carbon\Carbon::now()->toIso8601String())
                        ->orderBy('published_at', 'DESC')
                        ->when($hideLatest, fn($query) => $query->offset(1))
                        ->limit(4)
                        ->get();
                break;
                // Fetch featured article by it's ID.
                case 'featured_article':
                    if($block['extras']['latest']) {
                        $appendExtra['article'] = Article::with('article_category')->orderBy('published_at', 'DESC')->first();
                    } else {
                        $articleId = $block->extras['article_id'];
                        $appendExtra['article'] = Article::with('article_category')->find($articleId);
                    }
                break;
            }

            $block->extras = array_merge($block->extras, $appendExtra);
        }

        return $blocks;
    }
}
