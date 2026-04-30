<?php
namespace App\Http\Controllers\Auth;
use App\Actions\HandleSocialLoginAction;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
class SocialAuthController extends Controller
{
    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback(string $provider, HandleSocialLoginAction $handleSocialLoginAction): RedirectResponse
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $handleSocialLoginAction->execute($socialUser, $provider);
            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Social authentication failed.');
        }
    }
}
