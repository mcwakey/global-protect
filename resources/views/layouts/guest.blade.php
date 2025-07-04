<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Globale Protect') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Colors -->
        @php
            $primaryColor = \App\Models\Setting::get('primary_color', '#2563eb');
            $secondaryColor = \App\Models\Setting::get('secondary_color', '#1e40af');
            $accentColor = \App\Models\Setting::get('accent_color', '#3b82f6');
        @endphp
        <style>
            :root {
                --primary-color: {{ $primaryColor }};
                --secondary-color: {{ $secondaryColor }};
                --accent-color: {{ $accentColor }};
            }

            /* Primary Colors */
            .bg-primary { background-color: var(--primary-color) !important; }
            .text-primary { color: var(--primary-color) !important; }
            .border-primary { border-color: var(--primary-color) !important; }
            .hover\:bg-primary:hover { background-color: var(--primary-color) !important; }
            .hover\:text-primary:hover { color: var(--primary-color) !important; }
            .focus\:ring-primary:focus { --tw-ring-color: var(--primary-color) !important; }
            .focus\:border-primary:focus { border-color: var(--primary-color) !important; }

            /* Secondary Colors */
            .bg-secondary { background-color: var(--secondary-color) !important; }
            .text-secondary { color: var(--secondary-color) !important; }
            .border-secondary { border-color: var(--secondary-color) !important; }
            .hover\:bg-secondary:hover { background-color: var(--secondary-color) !important; }
            .hover\:text-secondary:hover { color: var(--secondary-color) !important; }

            /* Accent Colors */
            .bg-accent { background-color: var(--accent-color) !important; }
            .text-accent { color: var(--accent-color) !important; }
            .border-accent { border-color: var(--accent-color) !important; }
            .hover\:bg-accent:hover { background-color: var(--accent-color) !important; }
            .hover\:text-accent:hover { color: var(--accent-color) !important; }

            /* Color Variations with Opacity */
            .bg-primary\/10 { background-color: color-mix(in srgb, var(--primary-color) 10%, transparent) !important; }
            .bg-primary\/20 { background-color: color-mix(in srgb, var(--primary-color) 20%, transparent) !important; }
            .bg-primary\/50 { background-color: color-mix(in srgb, var(--primary-color) 50%, transparent) !important; }
            .bg-primary\/80 { background-color: color-mix(in srgb, var(--primary-color) 80%, transparent) !important; }
            .bg-primary\/90 { background-color: color-mix(in srgb, var(--primary-color) 90%, transparent) !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-background text-foreground transition-colors duration-300">
        <div class="min-h-screen flex">
            <!-- Left Side - Hero Image -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary via-primary to-primary/80 relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)"/>
                    </svg>
                </div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col justify-center px-12 py-12 text-primary-foreground">
                    <div class="max-w-md">
                        @if(request()->routeIs('register'))
                            <h1 class="text-4xl font-bold mb-6">{{ __('messages.join_our_team') }}</h1>
                            <p class="text-xl mb-8 opacity-90">{{ __('messages.register_subtitle') }}</p>
                        @else
                            <h1 class="text-4xl font-bold mb-6">{{ __('messages.welcome_back') }}</h1>
                            <p class="text-xl mb-8 opacity-90">{{ __('messages.login_subtitle') }}</p>
                        @endif

                        <!-- Features List -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-primary-foreground/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-sm"></i>
                                </div>
                                <span>{{ __('messages.secure_access') }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-primary-foreground/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-tachometer-alt text-sm"></i>
                                </div>
                                <span>{{ __('messages.admin_dashboard') }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-primary-foreground/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-globe text-sm"></i>
                                </div>
                                <span>{{ __('messages.multilingual_support') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Services Illustration -->
                <div class="absolute bottom-0 right-0 w-64 h-64 opacity-20">
                    <svg viewBox="0 0 200 200" class="w-full h-full">
                        <!-- Emergency Vehicle -->
                        <rect x="50" y="120" width="100" height="40" fill="white" rx="5"/>
                        <rect x="60" y="110" width="80" height="20" fill="white" rx="3"/>
                        <circle cx="70" cy="170" r="8" fill="white"/>
                        <circle cx="130" cy="170" r="8" fill="white"/>
                        <!-- Emergency Lights -->
                        <rect x="80" y="105" width="15" height="8" fill="red" rx="2"/>
                        <rect x="105" y="105" width="15" height="8" fill="blue" rx="2"/>
                        <!-- Cross Symbol -->
                        <rect x="90" y="125" width="20" height="4" fill="red"/>
                        <rect x="98" y="117" width="4" height="20" fill="red"/>
                    </svg>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 sm:px-12 lg:px-16 xl:px-20">
                <!-- Language Switcher -->
                <div class="absolute top-6 right-6">
                    <div class="flex items-center space-x-2">
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="p-2 rounded-md hover:bg-secondary transition-colors">
                            <i class="fas fa-moon text-foreground dark:hidden"></i>
                            <i class="fas fa-sun text-foreground hidden dark:block"></i>
                        </button>

                        <!-- Language Switcher -->
                        <select id="language-selector" class="bg-secondary text-secondary-foreground rounded-md px-3 py-1 text-sm border border-border">
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 EN</option>
                            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 FR</option>
                        </select>
                    </div>
                </div>

                <!-- Logo and Header -->
                <div class="mb-8 text-center">
                    <a href="{{ route('home') }}" class="inline-block mb-6">
                        <div class="flex items-center justify-center space-x-3">
                            @php
                                $logo = \App\Models\Setting::get('logo');
                            @endphp
                            @if($logo)
                                <img src="{{ $logo }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
                            @else
                                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-primary-foreground"></i>
                                </div>
                                <span class="text-2xl font-bold text-primary">{{ config('app.name') }}</span>
                            @endif
                        </div>
                    </a>
                    @if(request()->routeIs('register'))
                        <h2 class="text-2xl font-bold text-foreground mb-2">{{ __('messages.create_account') }}</h2>
                        <p class="text-muted-foreground">{{ __('messages.enter_credentials') }}</p>
                    @else
                        <h2 class="text-2xl font-bold text-foreground mb-2">{{ __('messages.sign_in_account') }}</h2>
                        <p class="text-muted-foreground">{{ __('messages.enter_credentials') }}</p>
                    @endif
                </div>

                <!-- Form Container -->
                <div class="w-full max-w-md mx-auto">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    @if(request()->routeIs('register'))
                        <p class="text-sm text-muted-foreground">
                            {{ __('messages.already_registered') }}
                            <a href="{{ route('login') }}" class="text-primary hover:text-primary/80 font-medium">
                                {{ __('messages.sign_in') }}
                            </a>
                        </p>
                    @else
                        <p class="text-sm text-muted-foreground">
                            {{ __('messages.dont_have_account') }}
                            <a href="{{ route('register') }}" class="text-primary hover:text-primary/80 font-medium">
                                {{ __('messages.sign_up') }}
                            </a>
                        </p>
                    @endif
                </div>

                <!-- Back to Site -->
                <div class="mt-4 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>{{ __('messages.back_to_site') }}
                    </a>
                </div>
            </div>
        </div>

        <script>
            // Theme toggle functionality
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;

            function updateTheme() {
                const theme = localStorage.getItem('theme') || 'light';
                html.classList.toggle('dark', theme === 'dark');
            }

            themeToggle.addEventListener('click', () => {
                const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', newTheme);
                updateTheme();
            });

            // Language switcher
            const languageSelector = document.getElementById('language-selector');
            languageSelector.addEventListener('change', function() {
                window.location.href = `/lang/${this.value}`;
            });

            // Initialize theme
            updateTheme();
        </script>
    </body>
</html>
