<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model{
    
    use HasFactory;

    //fields that can be filled in
    protected $fillable = [
        'title',
        'link',
        'description',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    //protects id from forced insertion
    protected $guarded = ['id'];
}
