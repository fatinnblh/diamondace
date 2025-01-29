<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle(Request $request)
    {
        try {
            /** @var GoogleProvider $googleDriver */
            $googleDriver = Socialite::driver('google')
                ->stateless()
                ->scopes([
                    'https://www.googleapis.com/auth/userinfo.email',
                    'https://www.googleapis.com/auth/userinfo.profile'
                ]);

            // Optional: Store intended URL for post-authentication redirect
            if ($request->has('intended')) {
                session(['url.intended' => $request->input('intended')]);
            }
            
            return $googleDriver->redirect();
        } catch (Exception $e) {
            Log::error('Google OAuth Redirect Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'client_id' => config('services.google.client_id'),
                'redirect_url' => config('services.google.redirect'),
            ]);

            return redirect('/login')->with('error', 'Unable to initiate Google authentication: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Google callback and register/login the user.
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

            // Detailed logging of received user data
            Log::info('Google User Data', [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
            ]);

            // Validate Google user data
            $this->validateGoogleUser($googleUser);

            // Find or create user with enhanced Google account integration
            $user = $this->findOrCreateUserWithGoogleDetails($googleUser);

            // Login the user
            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (Exception $e) {
            // Comprehensive error logging
            Log::error('Google Authentication Callback Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'client_id' => config('services.google.client_id'),
                'redirect_url' => config('services.google.redirect'),
            ]);

            return redirect('/login')->with('error', 'Authentication failed: ' . $e->getMessage());
        }
    }

    /**
     * Validate Google user data.
     *
     * @param SocialiteUser $googleUser
     * @throws \Exception
     */
    private function validateGoogleUser(SocialiteUser $googleUser)
    {
        if (!$googleUser) {
            throw new \Exception('Invalid Google user data');
        }

        if (!$googleUser->getEmail()) {
            throw new \Exception('Email not provided by Google');
        }
    }

    /**
     * Find or create a user with detailed Google account information.
     *
     * @param SocialiteUser $googleUser
     * @return User
     */
    protected function findOrCreateUserWithGoogleDetails(SocialiteUser $googleUser): User
    {
        return User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?? 'Google User',
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
                // Additional Google-specific fields
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken ?? null,
            ]
        );
    }

    /**
     * Disconnect Google account from the user's profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disconnectGoogleAccount()
    {
        $user = Auth::user();

        if ($user) {
            $user->update([
                'google_id' => null,
                'avatar' => null,
                'google_token' => null,
                'google_refresh_token' => null,
            ]);

            return redirect()->back()->with('success', 'Google account disconnected successfully.');
        }

        return redirect()->back()->with('error', 'Unable to disconnect Google account.');
    }
}
