<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locales = ['hr'];
        foreach ($locales as $locale) {
            try {
                Artisan::call('translatable:export ' . $locale);
                $filePath = lang_path($locale . '.json');
                if (File::exists($filePath)) {
                    $this->info('Translating ' . $locale . ', please wait...');
                    $results = [];
                    $localeFile = File::get($filePath);
                    $localeFileContent = array_keys(json_decode($localeFile, true));
                    $translator = new GoogleTranslate($locale);
                    $translator->setSource('en');
                    foreach ($localeFileContent as $key) {
                        $results[$key] = $translator->translate($key);
                    }
                    File::put($filePath, json_encode($results, JSON_UNESCAPED_UNICODE));
                }
            } catch (\Exception $e) {
                $this->error('Error: ' . $e->getMessage());
            }
        }
        return Command::SUCCESS;
    }
}
