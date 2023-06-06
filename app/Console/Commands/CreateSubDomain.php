<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Database\Models\Domain;

class CreateSubDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subdomain:create {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new sub domain with a given name and email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domain_name = $this->argument('name');
        $email = $this->argument('email');
        $password = 'admin@123';
        $domain = Domain::where('domain', $domain_name)->count();

        if ($domain) {
            $this->error("Domain {$domain_name} already exists.");
        }

        $tenant = new Tenant();
        $tenant->plan = 'free';
        $tenant->save();
        $this->info("create tenant successfully.");
        $tenant->domains()->create([
            'domain' => $domain_name,
        ]);

        Artisan::call('tenants:seed', [
            '--tenants' => [$tenant->id] // Array
        ]);

        $tenant->run(function () use ($email, $password) {
            User::create([
                'name' => 'Administrator',
                'email' => $email,
                'password' => bcrypt($password),
                'type' => 'admin',
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        $this->info("Domain Created Successfully with password {$password}");

        return Command::SUCCESS;
    }
}
