<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'client',
        'type',
        'images',
        'url',
        'expiration_date',
    ];

    public function get_type(){
        return $this->belongsTo(AdsType::class, 'uuid' ,'type');
    }

}
