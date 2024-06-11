<?php

namespace App\DTOs;


use App\Http\Requests\UpdateUserProfileRequest;
use App\Traits\MergeRequestParamForValidation;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserProfileDTO extends DataTransferObject
{
    use MergeRequestParamForValidation;

    public string $name;
    public string $email;

    public string $user_id;
    public string $status;
  

    public static function fromRequest(UpdateUserProfileRequest $request): self
    {
        return new self([
            'name' => $request["name"],
            'email' => $request["email"],
            'user_id' => $request["user_id"],
            'status' => $request["status"],
        ]);
    }
}

