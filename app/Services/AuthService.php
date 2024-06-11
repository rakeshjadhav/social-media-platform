<?php

namespace App\Services;

use App\DTOs\UpdateUserProfileDTO;
use App\DTOs\UserLoginDTO;
use App\DTOs\UserRegisterDTO;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;


class AuthService extends BaseService
{
    public function __construct(protected readonly UserRepository $userRepository)
    {
    }

    public function userRegistrationProcess(UserRegisterDTO $userRegisterDTO): ?User
    {
        $userRegisterResponse = $this->userRepository->createRegisterUser($userRegisterDTO);
        return $userRegisterResponse;
    }

     function userLoginProcess(string $userEmail): ?User
      {
        $userOrgDetails = $this->userRepository->checkUserByEmail($userEmail);
        return $userOrgDetails;
     }

     public function updateUserProfile(UpdateUserProfileDTO $payload, string $id)
     {
             $user = $this->userRepository->updateUserProfile($payload, $id);
             return $user;
     }
}
