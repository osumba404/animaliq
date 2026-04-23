<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumCommentLike extends Model
{
    protected $fillable = ['forum_comment_id', 'user_id'];
}
