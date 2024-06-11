<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateUserProfileDTO;
use App\DTOs\UserLoginDTO;
use App\DTOs\UserRegisterDTO;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;


class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function register(UserRegisterRequest $userRegisterRequest)
    {
        $userRegisterDataPayload = UserRegisterDTO::fromRequest($userRegisterRequest);
        $result = $this->authService->userRegistrationProcess($userRegisterDataPayload);
        return response()->json(['result' => $result], 200);
    }

    public function updateUserProfile(UpdateUserProfileRequest $updateUserProfileRequest, string $id): ?User
    {
        $data = UpdateUserProfileDTO::fromRequest($updateUserProfileRequest);
        return $this->authService->updateUserProfile($data, $id);
    }
    
}
