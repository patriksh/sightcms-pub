<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Multitenancy\Commands\Concerns\TenantAware;

// A command to add an admin user, mainly for testing purposes.
class MongoDBModelFix extends Command
{
    use TenantAware;

    protected $signature = 'add:admin {--tenant=*}';

    protected $description = 'Add an admin user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $input = [
            'email' => $this->ask('Enter an email'),
            'password' => bcrypt($this->secret('Enter a password'))
        ];

        $user = User::create([
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        $user->assignRole('admin');

        $this->info('Admin user created.');

        return Command::SUCCESS;
    }
}