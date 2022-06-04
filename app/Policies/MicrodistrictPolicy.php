<?php

namespace App\Policies;

use App\Models\Microdistrict\Microdistrict;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MicrodistrictPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Microdistrict $microdistrict): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Microdistrict $microdistrict): bool
    {
        //
    }

    public function delete(User $user, Microdistrict $microdistrict): bool
    {
        //
    }

    public function restore(User $user, Microdistrict $microdistrict): bool
    {
        //
    }

    public function forceDelete(User $user, Microdistrict $microdistrict): bool
    {
        //
    }
}