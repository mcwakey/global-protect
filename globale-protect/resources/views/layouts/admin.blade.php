<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Globale Protect') }} - {{ __('messages.admin_dashboard') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .bg-secondary\/10 { background-color: color-mix(in srgb, var(--secondary-color) 10%, transparent) !important; }
        .bg-secondary\/20 { background-color: color-mix(in srgb, var(--secondary-color) 20%, transparent) !important; }
        .bg-secondary\/80 { background-color: color-mix(in srgb, var(--secondary-color) 80%, transparent) !important; }
    </style>
</head>
<body class="bg-background text-foreground transition-colors duration-300">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-background border-b border-border">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-3">
                        @php
                            $logo = \App\Models\Setting::get('logo');
                        @endphp
                        @if($logo)
                            <img src="{{ $logo }}" alt="{{ config('app.name') }}" class="h-8 w-auto">
                        @else
                            <h1 class="text-2xl font-bold text-primary">{{ config('app.name') }}</h1>
                        @endif
                        <span class="text-sm text-muted-foreground">{{ __('messages.admin_panel') }}</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Language Switcher -->
                        <div class="relative">
                            <select id="language-selector" class="bg-secondary text-secondary-foreground rounded-md px-3 py-1 text-sm border border-border">
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 EN</option>
                                <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 FR</option>
                            </select>
                        </div>

                        <!-- Dark Mode Toggle -->
                        <button id="theme-toggle" class="p-2 rounded-md hover:bg-secondary transition-colors">
                            <i class="fas fa-moon text-foreground dark:hidden"></i>
                            <i class="fas fa-sun text-foreground hidden dark:block"></i>
                        </button>

                        <!-- View Site -->
                        <a href="{{ route('home') }}" class="text-muted-foreground hover:text-primary transition-colors">
                            <i class="fas fa-external-link-alt mr-2"></i>{{ __('messages.view_site') }}
                        </a>

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button id="profile-dropdown" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <span class="sr-only">{{ __('messages.open_user_menu') }}</span>
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                    <span class="text-primary-foreground font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                            </button>
                            <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-background border border-border rounded-md shadow-lg z-50">
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-foreground hover:bg-secondary">{{ __('messages.profile') }}</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-foreground hover:bg-secondary">
                                            {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 bg-secondary border-r border-border min-h-screen">
                <div class="p-4">
                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-background' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            {{ __('messages.dashboard') }}
                        </a>
                        <a href="{{ route('admin.sections.index') }}"
                           class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.sections.*') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-background' }}">
                            <i class="fas fa-layer-group mr-3"></i>
                            {{ __('messages.sections') }}
                        </a>
                        <a href="{{ route('admin.features.index') }}"
                           class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.features.*') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-background' }}">
                            <i class="fas fa-star mr-3"></i>
                            {{ __('messages.features') }}
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}"
                           class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.testimonials.*') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-background' }}">
                            <i class="fas fa-quote-left mr-3"></i>
                            {{ __('messages.testimonials') }}
                        </a>
                        <a href="{{ route('admin.contact-messages.index') }}"
                           class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.contact-messages.*') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-background' }}">
                            <i class="fas fa-envelope mr-3"></i>
                            {{ __('messages.contact_messages') }}
                        </a>
                        <a href="{{ route('admin.settings.index') }}"
                           class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-background' }}">
                            <i class="fas fa-cog mr-3"></i>
                            {{ __('messages.settings') }}
                        </a>

                        <!-- User Manual -->
                        <div class="border-t border-border my-2"></div>
                        <a href="{{ route('admin.manual.index') }}"
                           class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.manual.*') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-background' }}">
                            <i class="fas fa-book mr-3"></i>
                            {{ __('messages.user_manual') }}
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-background">
                    <div class="container mx-auto px-6 py-8">
                        @yield('content')
                    </div>
                </main>
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

        // Profile dropdown
        const profileDropdown = document.getElementById('profile-dropdown');
        const profileMenu = document.getElementById('profile-menu');

        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function() {
            profileMenu.classList.add('hidden');
        });

        // Initialize theme
        updateTheme();
    </script>
</body>
</html>
