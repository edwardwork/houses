<?php

namespace Database\Seeders;

use App\Enums\Roles\RoleType;
use Illuminate\Database\Seeder;
use ReflectionException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    private array $data = [];

    public function run(): void
    {
        $this->loadData();
        $this->seedRoles();
    }

    public function loadData(): void
    {
        $this->data = require database_path("data/permissions_roles.php");
    }

    private function seedRoles(): void
    {
        Role::query()->firstOrCreate(['name' => RoleType::SUPER_ADMIN, 'guard_name' => 'user']);

        foreach ($this->data as $roleName => $perms) {
            $role = Role::query()->firstOrCreate(['name' => $roleName, 'guard_name' => 'user']);

            $permissions = [];

            foreach ($perms as $perm) {
                $permissions[] = Permission::findOrCreate($perm, 'user');
            }

            $role->syncPermissions($permissions);
        }
    }
}
