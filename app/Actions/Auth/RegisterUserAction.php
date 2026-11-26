<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    /**
     * @param  array<string, mixed>  $data
     * @return array{user: User, token: string}
     */
    public function execute(array $data): array
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'phone'      => $data['phone'],
            'email'      => $data['email'] ?? null,
            'password'   => Hash::make($data['password']),
            'role'       => User::ROLE_USER,
        ]);

        $token = $user->createToken('mobile_app')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
