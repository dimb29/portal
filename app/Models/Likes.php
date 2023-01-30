<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'post_id',
        'comment_id',
        'user_id',
        'user_type',

    ];

    public function comment(){
        return $this->belongsTo(Comment::class, 'id', 'comment_id');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
