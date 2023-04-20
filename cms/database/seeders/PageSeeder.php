<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    // Insert a demo page (Privacy Policy).
    protected $pages = [
        [
            'template' => 'generic',
            'name' => 'Privacy Policy',
            'title' => 'Privacy Policy',
            'content' => 'This is the Privacy Policy static page. You can edit it in your dashboard.'
        ]
    ];

    public function run()
    {
        foreach($this->pages as $item) {
            Page::create([
                'template' => $item['template'],
                'name' => $item['name'],
                'title' => $item['title'],
                'content' => $item['content']
            ]);
        }
    }
}
