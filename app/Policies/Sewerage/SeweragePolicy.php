<?php

namespace App\Policies\Sewerage;

use App\Enums\Roles\RoleType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeweragePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(RoleType::SUPER_ADMIN, RoleType::THIRD_TYPE_ROLE);
    }

    public function update(User $user): bool
    {
        return $user->hasAnyRole(RoleType::SUPER_ADMIN, RoleType::THIRD_TYPE_ROLE);
    }

    public function delete(User $user): bool
    {
        return $user->hasAnyRole(RoleType::SUPER_ADMIN, RoleType::THIRD_TYPE_ROLE);
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