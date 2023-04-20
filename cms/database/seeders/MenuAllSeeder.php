<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuAllSeeder extends Seeder
{
    // Insert demo menu items (Home, News, Events, Attractions, Gastronomy).
    protected $menuItems = [
        [
            'name' => 'Home',
            'type' => 'internal_link',
            'link' => '/'
        ],
        [
            'name' => 'News',
            'type' => 'internal_link',
            'link' => '/articles/news'
        ],
        [
            'name' => 'Events',
            'type' => 'internal_link',
            'link' => '/events'
        ],
        [
            'name' => 'Documents',
            'type' => 'internal_link',
            'link' => '/documents'
        ],
        [
            'name' => 'Attractions',
            'type' => 'internal_link',
            'link' => '/attractions'
        ],
        [
            'name' => 'Gastronomy',
            'type' => 'internal_link',
            'link' => '/gastronomy'
        ],
        [
            'name' => 'Contact',
            'type' => 'internal_link',
            'link' => '/contact'
        ],
    ];

    public function run()
    {
        foreach($this->menuItems as $item) {
            MenuItem::create([
                'name' => $item['name'],
                'type' => $item['type'],
                'link' => $item['link']
            ]);
        }
    }
}
