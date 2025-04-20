<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
    ];
}
