<?php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'member':
                return redirect()->intended('/member/dashboard');
            case 'agent':
                return redirect()->intended('/agent/dashboard');
            default:
                return redirect()->intended('/login');
        }
    }
}
