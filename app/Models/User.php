<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use Tymon\JWTAuth\Contracts\JWTSubject;



class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'password', 'gender', 'birth', 'phone' , 'email'];



}

