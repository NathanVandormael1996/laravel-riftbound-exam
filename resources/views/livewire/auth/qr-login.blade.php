<?php

use App\Models\QrLoginToken;
use Illuminate\Support\Str;
use Livewire\Volt\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

new class extends Component
{
    public $token;

    public function mount()
    {
        $this->generateToken();
    }

    public function generateToken()
    {
        $token = Str::random(32);
        
        QrLoginToken::create([
            'token' => $token,
            'expires_at' => now()->addMinutes(5),
        ]);

        $this->token = $token;
    }

    #[Livewire\Attributes\Computed]
    public function qrCode()
    {
        $url = route('qr.claim', ['token' => $this->token]);
        
        return QrCode::size(200)
            ->color(208, 191, 255) // sentry-light
            ->backgroundColor(15, 11, 28) // sentry-deep
            ->margin(2)
            ->generate($url);
    }

    public function checkStatus()
    {
        $qrToken = QrLoginToken::where('token', $this->token)
            ->where('expires_at', '>', now())
            ->first();

        if ($qrToken && $qrToken->user_id) {
            auth()->login($qrToken->user);
            $qrToken->delete();
            return redirect()->intended(route('dashboard', absolute: false));
        }

        if (!$qrToken) {
            $this->generateToken();
        }
    }
}; ?>

<div wire:poll.2s="checkStatus">
    <div class="relative group">
        {{-- Decorative Corners --}}
        <div class="absolute -top-2 -left-2 w-8 h-8 border-t-2 border-l-2 border-sentry-light rounded-tl-lg opacity-50 group-hover:opacity-100 transition-opacity"></div>
        <div class="absolute -top-2 -right-2 w-8 h-8 border-t-2 border-r-2 border-sentry-light rounded-tr-lg opacity-50 group-hover:opacity-100 transition-opacity"></div>
        <div class="absolute -bottom-2 -left-2 w-8 h-8 border-b-2 border-l-2 border-sentry-light rounded-bl-lg opacity-50 group-hover:opacity-100 transition-opacity"></div>
        <div class="absolute -bottom-2 -right-2 w-8 h-8 border-b-2 border-r-2 border-sentry-light rounded-br-lg opacity-50 group-hover:opacity-100 transition-opacity"></div>

        <div class="relative p-6 bg-sentry-deep border border-sentry-border rounded-xl shadow-[0_0_50px_rgba(208,191,255,0.1)] overflow-hidden">
            {{-- Scanning Line Animation --}}
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-sentry-light/10 to-transparent h-20 -translate-y-full animate-[scan_3s_linear_infinite]"></div>

            <div class="relative z-10 p-2 bg-sentry-deep rounded-lg border border-sentry-light/10">
                {!! $this->qrCode !!}
            </div>
            
            <div class="mt-6 flex flex-col items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-sentry-light/5 border border-sentry-light/10">
                    <div class="w-1.5 h-1.5 bg-sentry-light rounded-full animate-pulse"></div>
                    <span class="text-[9px] uppercase tracking-[2px] font-bold text-sentry-light opacity-80">Syncing with Rift...</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes scan {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(400%); }
        }
    </style>
</div>
