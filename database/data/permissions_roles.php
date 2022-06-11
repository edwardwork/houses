<?php

use App\Enums\Permissions\PermissionType;
use App\Enums\Roles\RoleType;

return [
    RoleType::FIRST_TYPE_ROLE => [
        PermissionType::VIEW,
        PermissionType::VIEW_ANY,
    ],
    RoleType::SECOND_TYPE_ROLE => [
        PermissionType::VIEW,
        PermissionType::VIEW_ANY,
        PermissionType::UPDATE_MEDIA,
    ],
    RoleType::THIRD_TYPE_ROLE => [
        PermissionType::VIEW,
        PermissionType::VIEW_ANY,
        PermissionType::CREATE,
        PermissionType::UPDATE,
        PermissionType::DELETE,
        PermissionType::UPDATE_MEDIA,
    ],
];