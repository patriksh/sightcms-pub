<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class MenuItem extends Model
{
    use CrudTrait;
    use UsesTenantConnection;

    protected $fillable = [
        'name',
        'type',
        'link',
        'page_id',
        'parent_id'
    ];

    // A menu item can have a parent menu item.
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    // A menu item can have a child menu item.
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    // A menu item can link to an internal static page.
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    // Get the menu tree (up to 2 levels).
    // From default Backpack page manager, I do not actually support menu nesting at the moment...
    // Might be added later.
    public static function getTree()
    {
        $menu = self::orderBy('lft')->get();

        if($menu->count()) {
            foreach($menu as $k => $menu_item) {
                $menu_item->children = collect([]);

                foreach($menu as $i => $menu_subitem) {
                    if($menu_subitem->parent_id == $menu_item->id) {
                        $menu_item->children->push($menu_subitem);

                        // remove the subitem for the first level
                        $menu = $menu->reject(function ($item) use ($menu_subitem) {
                            return $item->id == $menu_subitem->id;
                        });
                    }
                }
            }
        }

        return $menu;
    }

    // Get the correct link based on the type (internal, external...).
    public function url()
    {
        switch($this->type) {
            case 'external_link':
                return $this->link;
            break;
            case 'internal_link':
                return is_null($this->link) ? '#' : url($this->link);
            break;
            default:
                if($this->page) {
                    return url($this->page->slug);
                }
            break;
        }
    }
}
