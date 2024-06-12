<?php

namespace App\DTOs;

use App\Http\Requests\CreateSupplierAccountWithBankFormRequest;
use App\Http\Requests\UpdatePostFormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UpdatePostDTO extends DataTransferObject
{
    public string $post_id;
    public string $title;
    public string $body;
    public string $user_id;

    public static function fromRequest(UpdatePostFormRequest $payload): self
    {   
        $token = $payload->getToken();
        $getUserID = $token['values']['sub'] ?? null;

        return new self([
                "post_id" => $payload["post_id"],
                "title" => $payload["title"],
                "body" => $payload["body"],
                'user_id' => $getUserID,
        ]);
    }
}
