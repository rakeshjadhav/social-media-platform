<?php

namespace App\Http\Controllers;

use App\DTOs\CreatePostCommentDTO;
use App\DTOs\PostCommentLikeDTO;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostCommentFormRequest;
use App\Http\Requests\PostCommentLikeFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;

class CommentController extends Controller
{
    
    public function __construct(private readonly PostService $postService)
    {
    }

     ##### store user wise post 
     public function storePostComment(CreatePostCommentFormRequest $createPostCommentFormRequest, string $id)
     {
         $commentPayload = CreatePostCommentDTO::fromRequest($createPostCommentFormRequest);
         $result = $this->postService->storePostComment($commentPayload,$id);
         return response()->json(['result' => $result], 201);
     }

       ##### store user wise post comment likes 
       public function storeCommentLike(PostCommentLikeFormRequest $postCommentLikeFormRequest, string $id)
       {
           $commentPayload = PostCommentLikeDTO::fromRequest($postCommentLikeFormRequest);
           $result = $this->postService->storePostCommentLike($commentPayload,$id);
           return response()->json(['result' => $result], 201);
       }
}
