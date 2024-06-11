<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes,HasUuid;


    protected $table = 'likes';

    protected $fillable = ["comment_id"];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
