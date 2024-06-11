<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasUuid;
class Comment extends Model
{
    use HasFactory, SoftDeletes, HasUuid;
    protected $table = 'comments';

    protected $fillable = ["post_id", "user_id", "body"];


    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
