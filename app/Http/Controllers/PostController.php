<?php

namespace App\Http\Controllers;

use App\DTOs\CreatePostDTO;
use App\DTOs\UpdatePostDTO;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\CreatePostFormRequest;
use App\Http\Requests\UpdatePostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {
    }

    ##### create user wise post
    public function createPost(CreatePostFormRequest $createPostFormRequest)
    {
        $createSupplierPayload = CreatePostDTO::fromRequest($createPostFormRequest);
        $result = $this->postService->createPost($createSupplierPayload);
        return response()->json(['result' => $result], 201);
    }

    ##### update user wise post
    public function updatePost(UpdatePostFormRequest $updatePostFormRequest, string $id)
    {
        $updatePostPayload = UpdatePostDTO::fromRequest($updatePostFormRequest);
        $result = $this->postService->updatePost($updatePostPayload, $id);
        return response()->json(['result' => $result], 200);
    }

    ##### get post by post id
    public function getPostDetails(string $post_id)
    {
        $result = $this->postService->getPostDetails($post_id);
        return response()->json(['result' => $result], 200);
    }

    ##### soft delete post by post id
    public function deleteSupplierData(string $postId)
    {
        $result = $this->postService->deleteSupplierData($postId);
        return response()->json(['result' => $result], 204);
    }
}
