<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

// A fix for MongoDB support in external packages.
// Replaces the use statements in package model files with the MongoDB model class.
class MongoDBModelFix extends Command
{
    protected $signature = 'fix:mongodb {--rollback : Rollback the MongoDB model fix}';

    protected $description = 'Fixes vendor model files for MongoDB support';

    protected $mongoModel = 'Jenssegers\Mongodb\Eloquent\Model';

    protected $laravelModel = 'Illuminate\Database\Eloquent\Model';

    // Packages to fix.
    protected $folders = [
        'vendor/spatie/laravel-permission/src/',
        'vendor/spatie/laravel-multitenancy/src/',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if(!$this->option('rollback')) {
          	$this->fixFiles();
          	$this->info('Vendor model files have been fixed for MongoDB.');
        } else {
            $this->rollbackFiles();
          	$this->info('Vendor model files have been rolled back for MongoDB.');
        }
    }

    // Recursively gets all PHP files in a directory.
    protected function getPhpFiles($path)
    {
        $directory = new RecursiveDirectoryIterator($path);
        $iterator = new RecursiveIteratorIterator($directory);
        $files = new RegexIterator($iterator, '/.*.php\b/', RegexIterator::GET_MATCH);

        $fileList = [];
        foreach($files as $file) {
            $fileList[] = $file[0];
        }

        return $fileList;
    }

    // Fixes the package files.
    protected function fixFiles()
    {
        foreach($this->folders as $path) {
            $this->info('Handling ' . $path);
            try {
                foreach($this->getPhpFiles($path) as $filename) {
                    $fileContents = file_get_contents($filename);
                    // Replace the model class.
                    $fixedFileContents = str_replace($this->laravelModel, $this->mongoModel, $fileContents);
                    // Show an message if there was a change.
                    if($fileContents != $fixedFileContents) {
        	            file_put_contents($filename, $fixedFileContents);
                        $this->info($filename . ' has been fixed.');
                    }
                }
            } catch(\Exception $e) {
                $this->error('Could not find ' . $path);
                continue;
            }
        }

        // While we're already here, let's also fix the problem with "Unsupported driver [mongodb]".
        // This happens with and without registering the MongoDB service provider, so that's not a fix.
        // Seems to be a problem only when using laravel-multitenancy though, dig deeper later..
        $fixFilePath = 'vendor/laravel/framework/src/Illuminate/Database/Connectors/ConnectionFactory.php';
        $fixFileFind = 'default => throw new InvalidArgumentException("Unsupported driver [{$driver}]."),';
        $fixFileReplace = '\'mongodb\' => new \Jenssegers\Mongodb\Connection($config),' . PHP_EOL . '            ' . $fixFileFind; // smh
        file_put_contents($fixFilePath, str_replace($fixFileFind, $fixFileReplace, file_get_contents($fixFilePath)));
    }

    // Rollback the changes (like it will ever be needed).
    protected function rollbackFiles()
    {
        foreach($this->folders as $path) {
            $this->info('Handling ' . $path);
            try {
                foreach($this->getPhpFiles($path) as $filename) {
                    $fileContents = file_get_contents($filename);
                    $fixedFileContents = str_replace($this->mongoModel, $this->laravelModel, $fileContents);
                    if($fileContents != $fixedFileContents) {
        	            file_put_contents($filename, $fixedFileContents);
                        $this->info($filename . ' has been rolled back.');
                    }
                }
            } catch(\Exception $e) {
                $this->error('Could not find ' . $path);
                continue;
            }
        }
    }
}