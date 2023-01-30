<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';
    protected $fillable = [
        'name',
    ];
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
