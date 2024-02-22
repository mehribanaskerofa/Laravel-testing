<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    use HasFactory;

    protected $table='admin';
    public $rememberTokenName = null;

    protected $fillable=['email','password','is_admin'];

    protected $hidden=[
        'password'
    ];
}
