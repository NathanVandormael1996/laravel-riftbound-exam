<?php
namespace App\Actions;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as SocialUser;
use Illuminate\Support\Str;
class HandleSocialLoginAction
{
    public function execute(SocialUser $socialUser, string $provider): void
    {
        $user = User::updateOrCreate([
            'email' => $socialUser->getEmail(),
        ], [
            'name' => $socialUser->getName() ?? $socialUser->getNickname(),
            'social_id' => $socialUser->getId(),
            'social_type' => $provider,
            'avatar' => $socialUser->getAvatar(),
            'password' => Hash::make(Str::random(24)), // Random password for security
            'email_verified_at' => now(),
        ]);
        if (!$user->role) {
            $user->update(['role' => UserRole::CUSTOMER]);
        }
        Auth::login($user);
    }
}
