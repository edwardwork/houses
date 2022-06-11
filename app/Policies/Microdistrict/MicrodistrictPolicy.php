<?php

namespace App\Policies\Microdistrict;

use App\Enums\Roles\RoleType;
use App\Models\Microdistrict\Microdistrict;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MicrodistrictPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Microdistrict $microdistrict): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(RoleType::SUPER_ADMIN, RoleType::THIRD_TYPE_ROLE);
    }

    public function update(User $user, Microdistrict $microdistrict): bool
    {
        return $user->hasAnyRole(RoleType::SUPER_ADMIN, RoleType::THIRD_TYPE_ROLE);
    }

    public function delete(User $user, Microdistrict $microdistrict): bool
    {
        return $user->hasAnyRole(RoleType::SUPER_ADMIN, RoleType::THIRD_TYPE_ROLE);
    }

    public function restore(User $user, Microdistrict $microdistrict): bool
    {
        return false;
    }

    public function forceDelete(User $user, Microdistrict $microdistrict): bool
    {
        return false;
    }
}