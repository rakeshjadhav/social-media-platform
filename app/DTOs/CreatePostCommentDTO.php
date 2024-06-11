<?php

namespace App\DTOs;

use App\Http\Requests\CreatePostCommentFormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreatePostCommentDTO extends DataTransferObject
{

    public ?string $post_id;
    public string $body;
    public ?string $user_id;

    public static function fromRequest(CreatePostCommentFormRequest $request): self
    { 
        $token = $request->getToken();
        $getUserID = $token['values']['sub'] ?? null;

        return new self([
            'post_id' => $request["post_id"],
            'body' => $request["body"],
            'user_id' => $getUserID,
        ]);
    }
}
