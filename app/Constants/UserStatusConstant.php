<?php

namespace App\Constants;

enum UserStatusConstant: string
{
    public const BLOCKED = 'blocked'; 

    public const UNBLOCKED = 'unblocked';

    public const ACTIVE = 'active'; 
    
    public const INVITED = 'invited';

    public const DELETED = 'deleted';

}
