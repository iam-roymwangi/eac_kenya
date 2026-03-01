<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request): Response
    {
        $role = Auth::user()->role ?? 'client';

        if ($role === 'admin') {
            return redirect()->intended(config('fortify.home'));
        } elseif ($role === 'financer') {
            return redirect()->intended('/financer');
        }

        return redirect()->intended('/client');
    }
}
