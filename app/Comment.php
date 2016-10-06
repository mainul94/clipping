<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['title', 'slug', 'parent_type', 'parent', 'comment'];
}
