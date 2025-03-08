<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }

    private function redirectUser($user): RedirectResponse
    {
        $role = $user->role;

        if ($role == 0) {
            return redirect()->intended(route('admin.dashboard', absolute: false).'?verified=1');
        } else if ($role == 1) {
            return redirect()->intended(route('tu.dashboard', absolute: false).'?verified=1');
        } else if ($role == 2) {
            return redirect()->intended(route('kaprodi.dashboard', absolute: false).'?verified=1');
        } else {
            return redirect()->intended(route('mahasiswa.dashboard', absolute: false).'?verified=1');
        }
    }

}
