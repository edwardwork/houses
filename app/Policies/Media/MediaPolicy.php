<?php

namespace App\Policies\Media;

use App\Enums\Permissions\PermissionType;
use App\Enums\Roles\RoleType;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaPolicy
{
    public function view(User $user, Media $media): bool
    {
        return true;
    }

    public function update(User $user, Media $media): bool
    {
        return $user->can(PermissionType::UPDATE_MEDIA);
    }

    public function delete(User $user, Media $media): bool
    {
        return $user->can(PermissionType::UPDATE_MEDIA);
    }
}