<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'comment',
        'meta_data',
        'author_id',
        'author_type',
        'post_id',
        'parent_id',
        'parent2_id',
    ];

    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function like(){
        return $this->hasMany(Likes::class, 'comment_id', 'id');
    }

    public function child(){
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(Comment::class,  'parent_id', 'id');
    }

    public function parent2(){
        return $this->belongsTo(Comment::class,  'parent2_id', 'id');
    }
}
