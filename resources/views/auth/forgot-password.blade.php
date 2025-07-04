<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-envelope text-primary text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-foreground mb-2">{{ __('messages.reset_password') }}</h3>
        <p class="text-sm text-muted-foreground">
            {{ __('messages.reset_password_message') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('messages.email')" class="text-sm font-medium text-foreground" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-muted-foreground text-sm"></i>
                </div>
                <x-text-input id="email"
                    class="block w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    placeholder="{{ __('messages.enter_email') }}" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base font-medium">
                <i class="fas fa-paper-plane mr-2"></i>
                {{ __('messages.send_reset_link') }}
            </x-primary-button>
        </div>

        <!-- Back to Login -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-primary hover:text-primary/80 font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('messages.back_to_login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
