<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $authUserRole = $request->user()->role;
            if ($authUserRole == 1) {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            } else if ($authUserRole == 2) {
                return redirect()->intended(route('tu.dashboard', absolute: false));
            } else if ($authUserRole == 3) {
                return redirect()->intended(route('kaprodi.dashboard', absolute: false));
            } else {
                return redirect()->intended(route('mahasiswa.dashboard', absolute: false));
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
