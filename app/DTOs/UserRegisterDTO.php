<?php

namespace App\DTOs;

use App\Http\Requests\UserRegisterRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UserRegisterDTO extends DataTransferObject
{
    public string $name;

    public string $email;

    public string $password;


    public static function fromRequest(UserRegisterRequest $userRegisterRequest): self
    {
        return new self([
            "name" => $userRegisterRequest["name"],
            "email" => $userRegisterRequest["email"],
            "password" => $userRegisterRequest["password"]
        ]);
    }

}