<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case Blocked = "blocked";
    case UnBlocked = "unblocked";
    case Active = 'active';
    case Invited = 'invited';
}
