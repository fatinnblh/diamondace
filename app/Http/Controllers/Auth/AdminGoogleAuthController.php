<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Exception;

class AdminGoogleAuthController extends Controller
{
    /**
     * Redirect the admin to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')
                ->stateless()
                ->scopes([
                    'https://www.googleapis.com/auth/userinfo.email',
                    'https://www.googleapis.com/auth/userinfo.profile'
                ])
                ->redirect();
        } catch (Exception $e) {
            Log::error('Admin Google OAuth Redirect Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect('/admin/login')->with('error', 'Unable to initiate Google authentication');
        }
    }

    /**
     * Handle the Google callback for admin login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            /** @var SocialiteUser $googleUser */
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            // Validate admin email
            $adminEmail = $googleUser->getEmail();
            $adminDomain = substr(strrchr($adminEmail, "@"), 1);

            $allowedEmails = config('app.admin.emails', []);
            $allowedDomains = config('app.admin.domains', []);

            $isAuthorizedEmail = in_array($adminEmail, $allowedEmails);
            $isAuthorizedDomain = in_array($adminDomain, $allowedDomains);

            if (!$isAuthorizedEmail && !$isAuthorizedDomain) {
                Log::warning("Unauthorized admin login attempt: {$adminEmail}");
                return redirect('/admin/login')->with('error', 'You are not authorized to access the admin panel.');
            }

            // Find or create admin user
            $adminUser = User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => $googleUser->getName() ?? 'Admin User',
                    'password' => bcrypt(Str::random(16)),
                    'email_verified_at' => now(),
                    // Force admin status for specific email
                    'is_admin' => $adminEmail === 'acethesis2u@gmail.com' ? true : false,
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            // Additional check to ensure admin status
            if ($adminEmail === 'acethesis2u@gmail.com') {
                $adminUser->is_admin = true;
                $adminUser->save();
            }

            // Login the admin
            Auth::login($adminUser);

            return redirect()->route('admin.dashboard');
        } catch (Exception $e) {
            Log::error('Admin Google Authentication Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect('/admin/login')->with('error', 'Authentication failed');
        }
    }
}
