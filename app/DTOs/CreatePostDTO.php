<?php

namespace App\DTOs;

use App\Http\Requests\CreatePostFormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreatePostDTO extends DataTransferObject
{

    public string $title;
    public string $body ;
    public ?string $user_id;

    public static function fromRequest(CreatePostFormRequest $request): self
    { 
        $token = $request->getToken();
        // dd($token );
        $getUserID = $token['values']['sub'] ?? null;

        return new self([
            'title' => $request["title"],
            'body' => $request["body"],
            'user_id' => $getUserID,

        ]);
    }
}
