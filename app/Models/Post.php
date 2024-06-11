<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasUuid;


    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public static function getCommentsDataWithPostId($id)
    {
        return self::with(['post_comments' => function ($query) {
            $query->orderBy('created_at', 'desc')->with('likes');
        }])->where('id', $id)->get();
    }

    public function post_comments()
    {
        return $this->hasMany(Comment::class);
    }
}
