<?php

namespace App\Http\Requests;

use App\Constants\UserStatusConstant;
use Kloo\Infrastructure\Requests\BaseFormRequest;
use App\Traits\MergeRequestParamForValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends BaseUserFormRequest
{
    use MergeRequestParamForValidation;

    public function __construct()
    {
    }

    public function rules(): array
    {
        $userId = $this->route("user_id");
        return [
            'email' => [
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique('users')->ignore($userId)->where(function ($query) use ($userId) {
                    if ($userId) {
                        $query->where("email", $this->email)
                            ->whereNull("deleted_at")
                            ->where("status", UserStatusConstant::ACTIVE);
                    }
                }),
            ],
            'name' => $this->defineNameRule(),
            "status" => [Rule::in(
                [
                    UserStatusConstant::ACTIVE,
                    UserStatusConstant::BLOCKED,
                    UserStatusConstant::UNBLOCKED,
                    UserStatusConstant::INVITED,
                ]
            )],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
