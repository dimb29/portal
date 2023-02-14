<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'type',
        'from',
        'to',
        'desc',
        'post_id',
        'read',
        'save'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function from(){
        return $this->belongsTo(User::class, 'from', 'id');
    }

    public function to(){
        return $this->belongsTo(User::class, 'to', 'id');
    }
}
