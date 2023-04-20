<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuTourismSeeder extends Seeder
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
            'name' => 'Attractions',
            'type' => 'internal_link',
            'link' => '/attractions'
        ],
        [
            'name' => 'Gastronomy',
            'type' => 'internal_link',
            'link' => '/gastronomy'
        ]
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
