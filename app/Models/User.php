<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Konstantinkotov\jwt\Traits\JWTModelTrait;
use Laravel\Sanctum\HasApiTokens;
use MoonShine\Models\MoonshineUser;

class User extends MoonshineUser
{
    use JWTModelTrait;

    protected $table = 'moonshine_users';
}
