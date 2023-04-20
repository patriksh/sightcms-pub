<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeBlock;

class HomeBlockSeeder extends Seeder
{
    // Insert demo home blocks (hero, articles).
    protected $homeBlocks = [
        [
            'block' => 'hero',
            'name' => 'Hero section',
            'extras' => [
                'title' => 'Welcome to your new website!',
                'text' => 'This is the Hero section of Home Blocks. You can edit it in your dashboard.',
                'buttons' => '[{"text":"Dashboard","url":"/admin/home-block"}]' // Bruh, has to be JSON encoded...
            ]
        ],
        [
            'block' => 'articles',
            'name' => 'Articles section',
            'extras' => [
                'title' => 'Latest articles',
                'subtitle' => 'This is the Articles section of Home Blocks. You can edit it in your dashboard.'
            ]
        ]    
    ];

    public function run()
    {
        foreach($this->homeBlocks as $item) {
            HomeBlock::create([
                'block' => $item['block'],
                'name' => $item['name'],
                'extras' => $item['extras']
            ]);
        }
    }
}
