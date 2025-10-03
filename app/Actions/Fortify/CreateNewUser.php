<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Agent;
use App\Models\Member;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validate input
        Validator::make($input, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                function ($attribute, $value, $fail) use ($input) {
                    $exists = User::where('email', $value)
                        ->where('role', $input['role'])
                        ->exists();
                    if ($exists) {
                        $fail('The email is already registered for this role.');
                    }
                },
            ],
            'password' => $this->passwordRules(),
            'role'     => ['required', 'in:member,agent,admin'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'license_number' => $input['role'] === 'agent' ? ['required', 'string'] : [],
            'agency_name'    => $input['role'] === 'agent' ? ['required', 'string'] : [],
            'terms'    => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Create user
        $user = User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
            'role'     => $input['role'],
        ]);

        // Insert into role-specific table
        switch ($input['role']) {
            case 'agent':
                Agent::create([
                    'user_id'        => $user->id,
                    'phone'          => $input['phone'] ?? null,
                    'license_number' => $input['license_number'],
                    'agency_name'    => $input['agency_name'],
                ]);
                break;

            case 'member':
                Member::create([
                    'user_id' => $user->id,
                    'phone'   => $input['phone'] ?? null,
                ]);
                break;

            case 'admin':
                Admin::create([
                    'user_id' => $user->id,
                    'phone'   => $input['phone'] ?? null,
                ]);
                break;
        }

        return $user;
    }
}
