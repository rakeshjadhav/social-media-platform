<?php

namespace App\Repositories;

use App\Constants\UserStatusConstant;
use App\DTOs\CreatePostCommentDTO;
use App\DTOs\CreatePostDTO;
use App\DTOs\PostCommentLikeDTO;
use App\DTOs\UpdatePostDTO;
use App\Exceptions\InternalServerErrorException;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostRepository extends BaseRepository
{
	public function createUserPost(CreatePostDTO $createPostDTO)
	{
		// dd($createPostDTO->user_id);
		return $postDetails = Post::create([
			'title' => $createPostDTO->title,
			'body' => $createPostDTO->body,
			'user_id' => $createPostDTO->user_id
		]);

	}
	


	public function updatePostContact(UpdatePostDTO $payload, $id): ?Post
    {   
		try {
			DB::beginTransaction();
			$userDetails = [
				'title' => $payload->title,
				'body' => $payload->body,
				'user_id' => $payload->user_id
			];
			$postData = Post::find($id);
			if ($postData) {
				$postData->update($userDetails);
			}
			DB::commit();
			return $postData;
		} catch (\Exception $e) {
			DB::rollBack();

			return response()->json(['error' => 'Something went wrong'], 500);
		}
    }

	public function getPostDetails(string $post_id): ?Collection    
	{
        $postDataWithComment = Post::getCommentsDataWithPostId($post_id);
		// dd( $postDataWithComment);
        return $postDataWithComment;
    }

	public function deletePostDataWithId($post_id): ?Post
    {
		try {
			DB::beginTransaction();
			
			//soft deleteing post for given post id here
			$postData = Post::findOrFail($post_id);

			if ($postData) {
				// $postData->user_id = '';
				$postData->delete();
				$postData->save();
			}
			DB::commit();
			return Post::withTrashed()->findOrFail($post_id);;
		} catch (\Exception $e) {
			DB::rollBack();
			return response()->json(['error' => 'Something went wrong'], 500);
		}
    }


	public function storePostComment(CreatePostCommentDTO $payload)
    {
        try {
            $postCommentDetails = Comment::create([
                'post_id' => $payload->post_id,
                'body' => $payload->body,
                'user_id' => $payload->user_id
            ]);
            $postWithAllsCommentDetails  = $this->getPostDetails($payload->post_id);
            return $postWithAllsCommentDetails;
        } catch (\Exception $e) {
            // Log the error message
            throw new InternalServerErrorException("Failed to create post comment: " . $e->getMessage());
        }
    }

	public function storePostCommentLike(PostCommentLikeDTO $payload, $commentId)
    {
        try {
            
		$comment = Comment::findOrFail($commentId);
        // Optionally, check if the comment has already been liked by the same user
        // if we  are implementing user-specific likes.
        $like = new Like();
        $like->comment()->associate($comment);
        $like->save();
		return $like;

        } catch (\Exception $e) {
			dd($e);
            // Log the error message
			throw new InternalServerErrorException("Failed to create post comment: " . $e->getMessage());
        }
    }
	
	
}
