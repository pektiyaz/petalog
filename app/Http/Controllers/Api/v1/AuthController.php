<?php

namespace  App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\LogoutResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Konstantinkotov\jwt\Resources\AccessAllowedResource;
use Konstantinkotov\jwt\Resources\AccessDeniedResource;
use Konstantinkotov\jwt\Traits\JWTControllerTrait;

class AuthController extends Controller
{
    use JWTControllerTrait;
    public function login(): JsonResource
    {
        $credentials = request(['email', 'password']);
        if(!auth()->attempt($credentials)){
            return (new AccessDeniedResource());
        }

        $user = User::query()->where('email', request('email'))->first();
        $token = $user->generateToken();

        return (new AccessAllowedResource($token));
    }

    public function logout() : JsonResource
    {
        $token = $this->token();
        User::query()->where('api_token', $token)->update([
            'api_token' => null
        ]);

        return (new LogoutResource());
    }
}
