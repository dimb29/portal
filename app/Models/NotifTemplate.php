<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_tag',
        'title',
        'desc',
    ];

    public function notif(){
        return $this->hasMany(Notification::class, 'type', 'id');
    }
}
