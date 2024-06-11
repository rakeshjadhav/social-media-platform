<?php

namespace App\DTOs;

use App\Http\Requests\UserLoginRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UserLoginDTO extends DataTransferObject
{

    public string $username;

    public string $password;


    public static function fromRequest(UserLoginRequest $userLoginRequest): self
    {
        return new self([
            "username" => $userLoginRequest["username"],
            "password" => $userLoginRequest["password"],
            "client_id" => $userLoginRequest["client_id"],
            "client_secret" => $userLoginRequest["client_secret"],
        ]);
    }

}