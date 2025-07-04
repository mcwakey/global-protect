<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $legalPage->title }} - {{ config('app.name', 'Globale Protect') }}</title>
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

        /* Color Variations with Opacity */
        .bg-primary\/10 { background-color: color-mix(in srgb, var(--primary-color) 10%, transparent) !important; }
    </style>
</head>
<body class="bg-background text-foreground transition-colors duration-300">
    <!-- Header -->
    <header class="bg-card shadow-sm border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold text-foreground">{{ config('app.name', 'Globale Protect') }}</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-muted-foreground hover:text-primary transition-colors">
                        {{ __('messages.home') }}
                    </a>

                    <!-- Language Switcher -->
                    <div class="relative">
                        <button id="language-toggle" class="flex items-center space-x-2 text-muted-foreground hover:text-primary transition-colors">
                            <i class="fas fa-globe"></i>
                            <span>{{ app()->getLocale() == 'fr' ? 'FR' : 'EN' }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div id="language-menu" class="hidden absolute right-0 mt-2 w-32 bg-card border border-border rounded-md shadow-lg z-50">
                            <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-sm text-foreground hover:bg-muted rounded-t-md">
                                🇺🇸 English
                            </a>
                            <a href="{{ route('language.switch', 'fr') }}" class="block px-4 py-2 text-sm text-foreground hover:bg-muted rounded-b-md">
                                🇫🇷 Français
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen bg-background">
        <div class="py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <nav class="flex mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-muted-foreground hover:text-primary">
                                <i class="fas fa-home mr-2"></i>
                                {{ __('messages.home') }}
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-muted-foreground mx-2"></i>
                                <span class="text-sm font-medium text-foreground">{{ $legalPage->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Page Header -->
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-6">
                        <i class="fas fa-file-contract text-primary text-2xl"></i>
                    </div>
                    <h1 class="text-4xl font-bold text-foreground mb-4">{{ $legalPage->title }}</h1>
                    <p class="text-lg text-muted-foreground">
                        {{ __('messages.last_updated') }}: {{ $legalPage->updated_at->format('F d, Y') }}
                    </p>
                </div>

                <!-- Legal Content -->
                <div class="bg-card rounded-xl shadow-lg border border-border overflow-hidden">
                    <div class="px-8 py-12">
                        <div class="prose prose-lg max-w-none">
                            <div class="text-foreground whitespace-pre-wrap leading-relaxed">
                                {{ $legalPage->content }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back to Home Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-6 py-3 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('messages.back') }} {{ __('messages.home') }}
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-card border-t border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-foreground">{{ config('app.name', 'Globale Protect') }}</span>
                    </div>
                    <p class="text-sm text-muted-foreground mb-4">
                        {{ __('messages.footer_description') }}
                    </p>
                </div>

                <!-- Legal Links -->
                <div>
                    <h3 class="text-sm font-semibold text-foreground uppercase tracking-wider mb-4">
                        {{ __('messages.legal_pages') }}
                    </h3>
                    <ul class="space-y-2">
                        @foreach(\App\Models\LegalPage::where('is_active', true)->get() as $page)
                        <li>
                            <a href="{{ route('legal.show', $page->type) }}"
                               class="text-sm text-muted-foreground hover:text-primary transition-colors {{ $page->id == $legalPage->id ? 'text-primary font-medium' : '' }}">
                                {{ $page->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-foreground uppercase tracking-wider mb-4">
                        {{ __('messages.quick_links') }}
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}#about" class="text-sm text-muted-foreground hover:text-primary transition-colors">
                                {{ __('messages.about') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#services" class="text-sm text-muted-foreground hover:text-primary transition-colors">
                                {{ __('messages.services') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#contact" class="text-sm text-muted-foreground hover:text-primary transition-colors">
                                {{ __('messages.contact') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-border mt-8 pt-8">
                <p class="text-center text-sm text-muted-foreground">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Globale Protect') }}. {{ __('messages.copyright') }}
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Language switcher with null checks
        const languageToggle = document.getElementById('language-toggle');
        const languageMenu = document.getElementById('language-menu');

        if (languageToggle && languageMenu) {
            languageToggle.addEventListener('click', function() {
                languageMenu.classList.toggle('hidden');
            });

            // Close language menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!languageToggle.contains(event.target) && !languageMenu.contains(event.target)) {
                    languageMenu.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>
