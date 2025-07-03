<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
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
                    autocomplete="username"
                    placeholder="{{ __('messages.enter_email') }}" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('messages.password')" class="text-sm font-medium text-foreground" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-muted-foreground text-sm"></i>
                </div>
                <x-text-input id="password"
                    class="block w-full pl-10 pr-12 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="{{ __('messages.enter_password') }}" />
                <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    onclick="togglePassword()">
                    <i id="password-toggle-icon" class="fas fa-eye text-muted-foreground text-sm hover:text-foreground transition-colors"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me"
                    type="checkbox"
                    class="rounded border-border text-primary shadow-sm focus:ring-primary focus:ring-offset-0"
                    name="remember">
                <span class="ml-2 text-sm text-foreground">{{ __('messages.remember_me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-primary hover:text-primary/80 font-medium transition-colors"
                   href="{{ route('password.request') }}">
                    {{ __('messages.forgot_password') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base font-medium">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('messages.sign_in') }}
            </x-primary-button>
        </div>

        <!-- Social Login Options (Optional) -->
        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-border"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-background text-muted-foreground">{{ __('messages.or_continue_with') }}</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <button type="button"
                    class="w-full inline-flex justify-center py-2 px-4 border border-border rounded-lg shadow-sm bg-background text-sm font-medium text-foreground hover:bg-secondary transition-colors">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    Google
                </button>
                <button type="button"
                    class="w-full inline-flex justify-center py-2 px-4 border border-border rounded-lg shadow-sm bg-background text-sm font-medium text-foreground hover:bg-secondary transition-colors">
                    <i class="fab fa-microsoft text-blue-500 mr-2"></i>
                    Microsoft
                </button>
            </div>
        </div>
    </form>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');

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
