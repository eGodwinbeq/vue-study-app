<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use softDeletes, HasFactory;

    protected $fillable = ['comment', 'user_id'];

    // what relationship do we have with posts?
    public function post()
    {
        return $this->belongsTo(Post::class);

    }
}
