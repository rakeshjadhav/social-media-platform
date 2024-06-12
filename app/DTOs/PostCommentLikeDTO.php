<?php

namespace App\DTOs;

use App\Http\Requests\PostCommentLikeFormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class PostCommentLikeDTO extends DataTransferObject
{

    public string $comment_id;
    public ?string $user_id;

    public static function fromRequest(PostCommentLikeFormRequest $request): self
    { 
        $token = $request->getToken();
        $getUserID = $token['values']['sub'] ?? null;

        return new self([
            'comment_id' => $request["comment_id"]
        ]);
    }
}
