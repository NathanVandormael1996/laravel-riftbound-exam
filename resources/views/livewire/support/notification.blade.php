<?php
use Livewire\Volt\Component;
new class extends Component
{
    public $notifications = [];
    public function addNotification($payload)
    {
        $id = uniqid();
        $this->notifications[$id] = [
            'type' => $payload['type'] ?? 'success',
            'message' => $payload['message'] ?? '',
        ];
        $this->dispatch('remove-notification', id: $id)->self();
    }
    public function removeNotification($id)
    {
        unset($this->notifications[$id]);
    }
}; ?>
<div 
    x-data="{ notifications: @entangle('notifications') }"
    class="fixed bottom-8 right-8 z-[100] flex flex-col space-y-4 pointer-events-none"
>
    @foreach($notifications as $id => $notif)
        <div 
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => { show = false; $wire.removeNotification('{{ $id }}') }, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-2 opacity-0 scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="pointer-events-auto sentry-glass p-4 min-w-[320px] flex items-center space-x-4 shadow-2xl border-l-4 {{ $notif['type'] === 'success' ? 'border-l-sentry-light' : 'border-l-sentry-pink' }}"
        >
            <div class="flex-shrink-0">
                @if($notif['type'] === 'success')
                    <svg class="w-6 h-6 text-sentry-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @else
                    <svg class="w-6 h-6 text-sentry-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @endif
            </div>
            <div class="flex-grow">
                <div class="sentry-label text-[8px] opacity-50 mb-0.5">Notification</div>
                <div class="text-sm font-medium text-white">{{ $notif['message'] }}</div>
            </div>
            <button @click="show = false" class="text-sentry-muted hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endforeach
</div>
