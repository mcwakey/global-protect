<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-key text-primary text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-foreground mb-2">{{ __('messages.reset_password') }}</h3>
        <p class="text-sm text-muted-foreground">
            Enter your new password below to reset your account password.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                    :value="old('email', $request->email)"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="{{ __('messages.enter_email') }}" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('messages.new_password')" class="text-sm font-medium text-foreground" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-muted-foreground text-sm"></i>
                </div>
                <x-text-input id="password"
                    class="block w-full pl-10 pr-12 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('messages.enter_new_password') }}" />
                <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    onclick="togglePassword('password')">
                    <i id="password-toggle-icon" class="fas fa-eye text-muted-foreground text-sm hover:text-foreground transition-colors"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" :value="__('messages.confirm_password')" class="text-sm font-medium text-foreground" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-muted-foreground text-sm"></i>
                </div>
                <x-text-input id="password_confirmation"
                    class="block w-full pl-10 pr-12 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('messages.enter_confirm_password') }}" />
                <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    onclick="togglePassword('password_confirmation')">
                    <i id="password_confirmation-toggle-icon" class="fas fa-eye text-muted-foreground text-sm hover:text-foreground transition-colors"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base font-medium">
                <i class="fas fa-save mr-2"></i>
                {{ __('messages.reset_password') }}
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

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId + '-toggle-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
