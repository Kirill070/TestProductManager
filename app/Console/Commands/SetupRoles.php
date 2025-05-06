<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetupRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup roles and permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $permissions = [
            'view products',
            'create products',
            'edit products',
            'delete products',
            'edit product article',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $user = Role::firstOrCreate(['name' => config('products.role'), 'guard_name' => 'web']);

        $admin->syncPermissions($permissions);
        $user->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'delete products',
        ]);

        $testUser = User::where('email', 'test@example.com')->first();
        if ($testUser) {
            $testUser->syncRoles(['admin']);
            $this->info('Admin role assigned to test@example.com');
        } else {
            $this->warn('User test@example.com not found');
        }

        $this->info('Roles and permissions setup completed!');
    }
}
