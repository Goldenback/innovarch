<?php

declare(strict_types=1);

namespace App\Enum;

enum UserRoleEnum: string
{
	case ROLE_USER = 'ROLE_USER';
	case ROLE_CLIENT = 'ROLE_CLIENT';
	case ROLE_ARCHITECT = 'ROLE_ARCHITECT';
	case ROLE_ADMIN = 'ROLE_ADMIN';
}