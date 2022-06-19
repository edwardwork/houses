<?php

namespace App\Policies\House;

use App\Enums\Roles\RoleType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HousePolicy
{
    use HandlesAuthorization;

    protected array $roles = [
        RoleType::SUPER_ADMIN,
        RoleType::FIRST_TYPE_ROLE,
        RoleType::SECOND_TYPE_ROLE,
        RoleType::THIRD_TYPE_ROLE,
    ];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole($this->roles);
    }

    public function view(User $user): bool
    {
        return $user->hasAnyRole($this->roles);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole($this->roles);
    }

    public function update(User $user): bool
    {
        return true;
    }

    public function delete(User $user): bool
    {
        return $user->hasRole(RoleType::SUPER_ADMIN);
    }

    public function restore(User $user): bool
    {
        return false;
    }

    public function forceDelete(User $user): bool
    {
        return false;
    }
}