<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['parent_type', 'parent', 'comment'];


    protected $hasSlugColumn = true;

    use CreateUpdateByRecord, HasComment;
}
