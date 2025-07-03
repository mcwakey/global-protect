<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('messages.name')" class="text-sm font-medium text-foreground" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-muted-foreground text-sm"></i>
                </div>
                <x-text-input id="name"
                    class="block w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                    autocomplete="new-password"
                    placeholder="{{ __('messages.enter_password') }}" />
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

        <!-- Terms Agreement -->
        <div class="space-y-4">
            <label for="agree_terms" class="flex items-start">
                <input id="agree_terms"
                    type="checkbox"
                    class="rounded border-border text-primary shadow-sm focus:ring-primary focus:ring-offset-0 mt-1"
                    name="agree_terms"
                    required>
                <span class="ml-2 text-sm text-foreground">
                    {{ __('messages.agree_to_terms') }}
                </span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base font-medium">
                <i class="fas fa-user-plus mr-2"></i>
                {{ __('messages.register') }}
            </x-primary-button>
        </div>

        <!-- Already Registered Link -->
        <div class="text-center">
            <p class="text-sm text-muted-foreground">
                {{ __('messages.already_registered') }}
                <a href="{{ route('login') }}" class="text-primary hover:text-primary/80 font-medium transition-colors">
                    {{ __('messages.sign_in') }}
                </a>
            </p>
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
