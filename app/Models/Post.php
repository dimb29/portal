<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'title',
        'content',
        'post_type',
        'meta_data',
        'author_id',
        'category_id',
        'views',
        'headline',
        'selected',
        'verified',
    ];
    
    // public function toSearchableArray(){
    
    //     $array = Post::with('kualifikasilulus')->toArray();
 
    //     return $array;
    // }

    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    // public function author_employer(){
    //     return $this->belongsTo(Employer::class, 'employer_id', 'id');
    // }

    public function like(){
        return $this->hasMany(Likes::class, 'post_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class)->with(['author', 'like']);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function postsave(){
        return $this->hasMany(User::class);
    }

    public function province(){
        return $this->belongsTo(Province::class, 'location_id', 'id');
    }
    public function regency(){
        return $this->belongsToMany(Regency::class);
    }
    public function district(){
        return $this->belongsToMany(District::class);
    }
}
