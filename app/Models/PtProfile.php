<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'about_us',
        'visi_misi',
    ];
}
