<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['parent_type', 'parent', 'comment', 'comment_id'];


    protected $hasSlugColumn = true;

    use CreateUpdateByRecord, HasComment;
}
