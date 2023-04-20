<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\PreferenceList;
use App\Models\Preference;

class PreferencesSeeder extends Seeder
{
    // Insert preferences (with default value if applicable).
    public function run()
    {
        $preferences = PreferenceList::get();

        foreach($preferences as $section => $items) {
            foreach($items as $item) {
                Preference::create([
                    'section' => $section,
                    'key' => $item['name'],
                    'value' => $item['default'] ?? null
                ]);
            }
        }
    }
}
