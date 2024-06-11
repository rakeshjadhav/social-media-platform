<?php

namespace App\Repositories;

use App\Constants\UserStatusConstant;
use App\DTOs\UpdateUserProfileDTO;
use App\DTOs\UserLoginDTO;
use App\DTOs\UserRegisterDTO;
use App\Enums\UserStatusEnum;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
	public function createRegisterUser(UserRegisterDTO $userRegisterDTO)
	{
		return $userDetails = User::create([
			'name' => $userRegisterDTO->name,
			'email' => $userRegisterDTO->email,
			'password' => Hash::make($userRegisterDTO->password),
			"status" => UserStatusConstant::ACTIVE
		]);
		// return $userDetails->createToken('LaravelAuthApp')->accessToken;

	}

	public function checkUserByEmail(string $userEmail): ?User
	{
		return User::where('email', $userEmail)->where('status', '=', UserStatusConstant::ACTIVE)->first();
	}

	public function updateUserProfile(UpdateUserProfileDTO $payload, $id): ?User
    {   
		try {
			DB::beginTransaction();
			$userDetails = [
				'name' => $payload->name,
				'email' => $payload->email,
				'status' => $payload->status
			];
			$user = User::ActiveUserType($id)->first();
			if ($user) {
				$user->update($userDetails);
			}
			DB::commit();
			return $user;
		} catch (\Exception $e) {
			DB::rollBack();
			return response()->json(['error' => 'Something went wrong'], 500);
		}
    }
}
