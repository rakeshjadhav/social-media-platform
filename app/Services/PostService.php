<?php

namespace App\Services;

use App\DTOs\CreatePostCommentDTO;
use App\DTOs\CreatePostDTO;
use App\DTOs\PostCommentLikeDTO;
use App\DTOs\UpdatePostDTO;
use App\Exceptions\BadRequestException;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;


class PostService extends BaseService
{
    public function __construct(protected readonly PostRepository $postRepository)
    {
    }

    public function createPost(CreatePostDTO $createPostDTO): ?Post
    {
        $userRPostResponse = $this->postRepository->createUserPost($createPostDTO);
        return $userRPostResponse;
    }

    public function updatePost(UpdatePostDTO $payload, string $id)
    {
        $postDetails = $this->postRepository->updatePostContact($payload, $id);
        return $postDetails;
    }

    public function getPostDetails(string $postId)
    {
        $supplierList = $this->postRepository->getPostDetails($postId);
        return $supplierList;
    }

    public function deleteSupplierData($post_id)
    {
        //checking post_id for validation before delete
        $delData = $this->postRepository->getPostDetails($post_id);
        if (empty($delData)) {
            throw new BadRequestException("This Post has already deleled or something else..");
        }
        // Deleting posts table for the given id
        return $this->postRepository->deletePostDataWithId($post_id);
    }


    public function storePostComment(CreatePostCommentDTO $payload, $id)
    {
        $postDetails = $this->postRepository->storePostComment($payload, $id);
        return $postDetails;
    }


    public function storePostCommentLike(PostCommentLikeDTO $payload, $id)
    {
        $postDetails = $this->postRepository->storePostCommentLike($payload, $id);
        return $postDetails;
    }
}
