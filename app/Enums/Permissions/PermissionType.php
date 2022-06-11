<?php

namespace App\Enums\Permissions;

class PermissionType
{
    public const VIEW = 'view';
    public const VIEW_ANY = 'view-any';
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const UPDATE_MEDIA = 'update-media';
    public const DELETE = 'delete';
}