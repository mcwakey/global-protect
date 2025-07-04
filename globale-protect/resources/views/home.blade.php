<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Globale Protect') }}</title>
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

        .bg-accent\/10 { background-color: color-mix(in srgb, var(--accent-color) 10%, transparent) !important; }
        .bg-accent\/20 { background-color: color-mix(in srgb, var(--accent-color) 20%, transparent) !important; }
    </style>
</head>
<body class="bg-background text-foreground transition-colors duration-300">
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 bg-background z-50 flex items-center justify-center">
        <div class="text-center">
            <div class="relative w-16 h-16 mx-auto mb-4">
                <div class="w-16 h-16 border-4 border-primary/20 rounded-full"></div>
                <div class="absolute top-0 left-0 w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
            </div>
            <div class="flex items-center justify-center space-x-3">
                @php
                    $logo = \App\Models\Setting::get('logo');
                @endphp
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ config('app.name') }}" class="h-8 w-auto">
                @else
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-primary-foreground"></i>
                    </div>
                    <span class="text-lg font-bold text-primary">Globale Protect</span>
                @endif
            </div>
            <p class="text-sm text-muted-foreground mt-2">{{ __('messages.loading') }}</p>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="bg-background/80 border-b border-border sticky top-0 z-50 backdrop-blur-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-3 group">
                        @php
                            $logo = \App\Models\Setting::get('logo');
                        @endphp
                        @if($logo)
                            <img src="{{ $logo }}" alt="{{ config('app.name') }}" class="h-8 w-auto group-hover:scale-110 transition-transform">
                        @else
                            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-shield-alt text-primary-foreground"></i>
                            </div>
                            <h1 class="text-2xl font-bold text-primary group-hover:text-primary/80 transition-colors">Globale Protect</h1>
                        @endif
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.home') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#about" class="text-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.about') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#services" class="text-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.services') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#testimonials" class="text-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.testimonials') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="text-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.contact') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>

                    <!-- Language Switcher -->
                    <div class="relative">
                        <select id="language-selector" class="bg-secondary text-secondary-foreground rounded-md px-3 py-1 text-sm border border-border hover:border-primary transition-colors">
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 EN</option>
                            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 FR</option>
                        </select>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-md hover:bg-secondary transition-all duration-200 hover:scale-110">
                        <i class="fas fa-moon text-foreground dark:hidden"></i>
                        <i class="fas fa-sun text-foreground hidden dark:block"></i>
                    </button>
                </div>
                <div class="md:hidden flex items-center space-x-2">
                    <!-- Mobile Dark Mode Toggle -->
                    <button id="mobile-theme-toggle" class="p-2 rounded-md hover:bg-secondary transition-all duration-200 hover:scale-110">
                        <i class="fas fa-moon text-foreground dark:hidden"></i>
                        <i class="fas fa-sun text-foreground hidden dark:block"></i>
                    </button>
                    <button id="mobile-menu-button" class="text-foreground hover:text-primary p-2 transition-transform hover:scale-110">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-background border-t border-border">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#home" class="block px-3 py-2 text-foreground hover:text-primary">{{ __('messages.home') }}</a>
                <a href="#about" class="block px-3 py-2 text-foreground hover:text-primary">{{ __('messages.about') }}</a>
                <a href="#services" class="block px-3 py-2 text-foreground hover:text-primary">{{ __('messages.services') }}</a>
                <a href="#testimonials" class="block px-3 py-2 text-foreground hover:text-primary">{{ __('messages.testimonials') }}</a>
                <a href="#contact" class="block px-3 py-2 text-foreground hover:text-primary">{{ __('messages.contact') }}</a>
                <div class="px-3 py-2">
                    <select id="mobile-language-selector" class="w-full bg-secondary text-secondary-foreground rounded-md px-3 py-1 text-sm border border-border">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 English</option>
                        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
                    </select>
                </div>
            </div>
        </div>
    </nav>    <!-- Hero Section -->
    @if(isset($sections['hero']))
    <section id="home" class="relative bg-gradient-to-r from-primary via-primary to-primary/80 text-primary-foreground overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hero-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hero-grid)"/>
            </svg>
        </div>

        <!-- Emergency Services Illustration -->
        <div class="absolute top-1/4 right-10 w-32 h-32 lg:w-48 lg:h-48 opacity-20 hidden lg:block">
            <svg viewBox="0 0 200 200" class="w-full h-full">
                <!-- Ambulance -->
                <rect x="40" y="120" width="120" height="50" fill="white" rx="8"/>
                <rect x="50" y="100" width="100" height="30" fill="white" rx="5"/>
                <!-- Wheels -->
                <circle cx="65" cy="180" r="12" fill="white"/>
                <circle cx="135" cy="180" r="12" fill="white"/>
                <!-- Emergency Lights -->
                <rect x="70" y="90" width="20" height="10" fill="#ff4444" rx="3"/>
                <rect x="110" y="90" width="20" height="10" fill="#4444ff" rx="3"/>
                <!-- Medical Cross -->
                <rect x="85" y="130" width="30" height="8" fill="#ff4444"/>
                <rect x="96" y="119" width="8" height="30" fill="#ff4444"/>
                <!-- Radio Wave -->
                <path d="M 170 60 Q 180 70 170 80" stroke="white" stroke-width="2" fill="none"/>
                <path d="M 175 65 Q 183 73 175 81" stroke="white" stroke-width="2" fill="none"/>
                <path d="M 180 70 Q 186 76 180 82" stroke="white" stroke-width="2" fill="none"/>
            </svg>
        </div>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left Side - Text Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight">
                        {{ __('messages.hero_title') }}
                    </h1>
                    <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 opacity-95 leading-relaxed">
                        {{ __('messages.hero_content') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#about"
                           class="bg-primary-foreground text-primary px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-primary-foreground/90 transition-all duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            {{ __('messages.learn_more') }}
                        </a>
                        <a href="#contact"
                           class="border border-primary-foreground text-primary-foreground px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-primary-foreground/10 transition-all duration-300 inline-block">
                            {{ __('messages.contact') }}
                        </a>
                    </div>
                </div>

                <!-- Right Side - Hero Image/Illustration -->
                <div class="relative">
                    <div class="relative bg-primary-foreground/10 rounded-2xl p-8 backdrop-blur-sm">
                        <!-- Emergency Dashboard Mockup -->
                        <div class="bg-primary-foreground rounded-xl p-6 shadow-2xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                </div>
                                <span class="text-primary text-sm font-medium">Emergency Dashboard</span>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3 bg-primary/5 p-3 rounded-lg">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-primary text-sm">Active Emergency Units: 12</span>
                                </div>
                                <div class="flex items-center space-x-3 bg-primary/5 p-3 rounded-lg">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                    <span class="text-primary text-sm">Response Time: 3.2 min</span>
                                </div>
                                <div class="flex items-center space-x-3 bg-primary/5 p-3 rounded-lg">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                                    <span class="text-primary text-sm">Incidents Resolved: 47</span>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 w-16 h-16 bg-primary-foreground/20 rounded-full flex items-center justify-center animate-bounce">
                            <i class="fas fa-heartbeat text-primary-foreground text-xl"></i>
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-12 h-12 bg-primary-foreground/20 rounded-full flex items-center justify-center animate-pulse">
                            <i class="fas fa-shield-alt text-primary-foreground"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <section id="home" class="relative bg-gradient-to-r from-primary via-primary to-primary/80 text-primary-foreground overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hero-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hero-grid)"/>
            </svg>
        </div>

        <!-- Emergency Services Illustration -->
        <div class="absolute top-1/4 right-10 w-32 h-32 lg:w-48 lg:h-48 opacity-20 hidden lg:block">
            <svg viewBox="0 0 200 200" class="w-full h-full">
                <!-- Ambulance -->
                <rect x="40" y="120" width="120" height="50" fill="white" rx="8"/>
                <rect x="50" y="100" width="100" height="30" fill="white" rx="5"/>
                <!-- Wheels -->
                <circle cx="65" cy="180" r="12" fill="white"/>
                <circle cx="135" cy="180" r="12" fill="white"/>
                <!-- Emergency Lights -->
                <rect x="70" y="90" width="20" height="10" fill="#ff4444" rx="3"/>
                <rect x="110" y="90" width="20" height="10" fill="#4444ff" rx="3"/>
                <!-- Medical Cross -->
                <rect x="85" y="130" width="30" height="8" fill="#ff4444"/>
                <rect x="96" y="119" width="8" height="30" fill="#ff4444"/>
                <!-- Radio Wave -->
                <path d="M 170 60 Q 180 70 170 80" stroke="white" stroke-width="2" fill="none"/>
                <path d="M 175 65 Q 183 73 175 81" stroke="white" stroke-width="2" fill="none"/>
                <path d="M 180 70 Q 186 76 180 82" stroke="white" stroke-width="2" fill="none"/>
            </svg>
        </div>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left Side - Text Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight">
                        {{ __('messages.hero_title') }}
                    </h1>
                    <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 opacity-95 leading-relaxed">
                        {{ __('messages.hero_content') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#about"
                           class="bg-primary-foreground text-primary px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-primary-foreground/90 transition-all duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            {{ __('messages.learn_more') }}
                        </a>
                        <a href="#contact"
                           class="border border-primary-foreground text-primary-foreground px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-primary-foreground/10 transition-all duration-300 inline-block">
                            {{ __('messages.contact') }}
                        </a>
                    </div>
                </div>

                <!-- Right Side - Hero Image/Illustration -->
                <div class="relative">
                    <div class="relative bg-primary-foreground/10 rounded-2xl p-8 backdrop-blur-sm">
                        <!-- Emergency Dashboard Mockup -->
                        <div class="bg-primary-foreground rounded-xl p-6 shadow-2xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                </div>
                                <span class="text-primary text-sm font-medium">Emergency Dashboard</span>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3 bg-primary/5 p-3 rounded-lg">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-primary text-sm">Active Emergency Units: 12</span>
                                </div>
                                <div class="flex items-center space-x-3 bg-primary/5 p-3 rounded-lg">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                    <span class="text-primary text-sm">Response Time: 3.2 min</span>
                                </div>
                                <div class="flex items-center space-x-3 bg-primary/5 p-3 rounded-lg">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                                    <span class="text-primary text-sm">Incidents Resolved: 47</span>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 w-16 h-16 bg-primary-foreground/20 rounded-full flex items-center justify-center animate-bounce">
                            <i class="fas fa-heartbeat text-primary-foreground text-xl"></i>
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-12 h-12 bg-primary-foreground/20 rounded-full flex items-center justify-center animate-pulse">
                            <i class="fas fa-shield-alt text-primary-foreground"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- About Section -->
    @if(isset($sections['about']))
    <section id="about" class="py-12 sm:py-16 lg:py-20 bg-background relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="about-dots" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="1.5" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#about-dots)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-6">
                    <i class="fas fa-info-circle text-primary text-2xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-foreground mb-4 sm:mb-6">
                    {{ __('messages.about_title') }}
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-muted-foreground max-w-4xl mx-auto leading-relaxed">
                    {{ __('messages.about_content') }}
                </p>
            </div>

            @if(isset($sections['about']->data['values']))
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 lg:gap-12 mt-8 sm:mt-12">
                @foreach($sections['about']->data['values'] as $index => $value)
                <div class="text-center group">
                    <div class="bg-primary/10 dark:bg-primary/20 rounded-full w-12 h-12 sm:w-16 sm:h-16 flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110 shadow-lg">
                        @switch($index)
                            @case(0) <i class="fas fa-lightbulb text-primary text-lg sm:text-xl"></i> @break
                            @case(1) <i class="fas fa-shield-alt text-primary text-lg sm:text-xl"></i> @break
                            @case(2) <i class="fas fa-heart text-primary text-lg sm:text-xl"></i> @break
                            @case(3) <i class="fas fa-star text-primary text-lg sm:text-xl"></i> @break
                            @default <i class="fas fa-check text-primary text-lg sm:text-xl"></i>
                        @endswitch
                    </div>
                    <h3 class="font-semibold text-foreground text-sm sm:text-base">
                        @switch($index)
                            @case(0) {{ __('messages.innovation') }} @break
                            @case(1) {{ __('messages.reliability') }} @break
                            @case(2) {{ __('messages.life_saving') }} @break
                            @case(3) {{ __('messages.excellence') }} @break
                            @default {{ $value }}
                        @endswitch
                    </h3>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @else
    <section id="about" class="py-12 sm:py-16 lg:py-20 bg-background relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="about-dots" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="1.5" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#about-dots)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-6">
                    <i class="fas fa-info-circle text-primary text-2xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-foreground mb-4 sm:mb-6">
                    {{ __('messages.about_title') }}
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-muted-foreground max-w-4xl mx-auto leading-relaxed">
                    {{ __('messages.about_content') }}
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 lg:gap-12 mt-8 sm:mt-12">
                <div class="text-center group">
                    <div class="bg-primary/10 dark:bg-primary/20 rounded-full w-12 h-12 sm:w-16 sm:h-16 flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110 shadow-lg">
                        <i class="fas fa-lightbulb text-primary text-lg sm:text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-foreground text-sm sm:text-base">{{ __('messages.innovation') }}</h3>
                </div>
                <div class="text-center group">
                    <div class="bg-primary/10 dark:bg-primary/20 rounded-full w-12 h-12 sm:w-16 sm:h-16 flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110 shadow-lg">
                        <i class="fas fa-shield-alt text-primary text-lg sm:text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-foreground text-sm sm:text-base">{{ __('messages.reliability') }}</h3>
                </div>
                <div class="text-center group">
                    <div class="bg-primary/10 dark:bg-primary/20 rounded-full w-12 h-12 sm:w-16 sm:h-16 flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110 shadow-lg">
                        <i class="fas fa-heart text-primary text-lg sm:text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-foreground text-sm sm:text-base">{{ __('messages.life_saving') }}</h3>
                </div>
                <div class="text-center group">
                    <div class="bg-primary/10 dark:bg-primary/20 rounded-full w-12 h-12 sm:w-16 sm:h-16 flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110 shadow-lg">
                        <i class="fas fa-star text-primary text-lg sm:text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-foreground text-sm sm:text-base">{{ __('messages.excellence') }}</h3>
                </div>
            </div>
        </div>
    </section>
    @endif    <!-- Services/Features Section -->
    @if($features->count() > 0)
    <section id="services" class="py-12 sm:py-16 lg:py-20 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-foreground mb-4 sm:mb-6">
                    {{ __('messages.services_title') }}
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-muted-foreground max-w-4xl mx-auto leading-relaxed">
                    {{ __('messages.services_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($features as $index => $feature)
                <div class="bg-card rounded-lg border border-border p-4 sm:p-6 hover:shadow-lg transition-all duration-300 group hover:-translate-y-1">
                    <div class="flex items-start mb-4">
                        <div class="bg-primary/10 dark:bg-primary/20 rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300">
                            <i class="{{ $feature->icon }} text-primary text-lg sm:text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg sm:text-xl font-semibold text-card-foreground mb-2 leading-tight">
                                @switch($index)
                                    @case(0) {{ __('messages.qwick_rescue') }} @break
                                    @case(1) {{ __('messages.qr_medical_info') }} @break
                                    @case(2) {{ __('messages.emergency_comm') }} @break
                                    @case(3) {{ __('messages.ai_dispatch') }} @break
                                    @case(4) {{ __('messages.mobile_command') }} @break
                                    @case(5) {{ __('messages.analytics_dashboard') }} @break
                                    @default {{ $feature->title }}
                                @endswitch
                            </h3>
                        </div>
                    </div>
                    <p class="text-sm sm:text-base text-muted-foreground mb-4 leading-relaxed">
                        @switch($index)
                            @case(0) {{ __('messages.qwick_rescue_desc') }} @break
                            @case(1) {{ __('messages.qr_medical_desc') }} @break
                            @case(2) {{ __('messages.emergency_comm_desc') }} @break
                            @case(3) {{ __('messages.ai_dispatch_desc') }} @break
                            @case(4) {{ __('messages.mobile_command_desc') }} @break
                            @case(5) {{ __('messages.analytics_desc') }} @break
                            @default {{ $feature->description }}
                        @endswitch
                    </p>
                    @if($feature->link)
                    <a href="{{ $feature->link }}" class="text-primary hover:text-primary/80 font-medium text-sm sm:text-base transition-colors duration-200 inline-flex items-center group/link">
                        {{ __('messages.learn_more') }}
                        <i class="fas fa-arrow-right ml-2 text-xs group-hover/link:translate-x-1 transition-transform duration-200"></i>
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
    <section id="testimonials" class="py-12 sm:py-16 lg:py-20 bg-muted/30 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="testimonial-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M20 5 L35 20 L20 35 L5 20 Z" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#testimonial-pattern)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-6">
                    <i class="fas fa-quote-left text-primary text-2xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-foreground mb-4 sm:mb-6">
                    {{ __('messages.testimonials_title') }}
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-muted-foreground max-w-4xl mx-auto leading-relaxed">
                    {{ __('messages.testimonials_subtitle') }}
                </p>
            </div>

            <!-- Testimonials Slider -->
            <div class="relative">
                <!-- Slider Container -->
                <div class="testimonials-slider overflow-hidden">
                    <div class="testimonials-track flex transition-transform duration-500 ease-in-out">
                        @foreach($testimonials as $index => $testimonial)
                        <div class="testimonial-slide flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-4">
                            <div class="bg-card rounded-xl border border-border p-6 hover:shadow-xl transition-all duration-300 group hover:-translate-y-2 h-full">
                                <!-- Quote Icon -->
                                <div class="flex justify-center mb-4">
                                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-quote-left text-primary"></i>
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="flex justify-center mb-4">
                                    @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fas fa-star text-yellow-500 text-lg mr-1"></i>
                                    @endfor
                                </div>

                                <!-- Testimonial Content -->
                                <p class="text-card-foreground mb-6 italic text-center leading-relaxed">
                                    "{{ $testimonial->content }}"
                                </p>

                                <!-- Author Info -->
                                <div class="flex items-center justify-center">
                                    @if($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}"
                                         alt="{{ $testimonial->name }}"
                                         class="w-14 h-14 rounded-full mr-4 object-cover border-2 border-primary/20">
                                    @else
                                    <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center mr-4 border-2 border-primary/20">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    @endif
                                    <div class="text-center">
                                        <h4 class="font-semibold text-card-foreground">{{ $testimonial->name }}</h4>
                                        <p class="text-sm text-muted-foreground">
                                            {{ $testimonial->position }}
                                            @if($testimonial->company)<br>{{ $testimonial->company }}@endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button id="testimonials-prev" class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 bg-primary text-primary-foreground w-12 h-12 rounded-full flex items-center justify-center hover:bg-primary/90 transition-colors shadow-lg z-10">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="testimonials-next" class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 bg-primary text-primary-foreground w-12 h-12 rounded-full flex items-center justify-center hover:bg-primary/90 transition-colors shadow-lg z-10">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Dots Indicator -->
                <div class="flex justify-center mt-8 space-x-2">
                    @foreach($testimonials as $index => $testimonial)
                    <button class="testimonial-dot w-3 h-3 rounded-full bg-muted-foreground/30 hover:bg-primary/50 transition-colors" data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-muted/30 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="contact-pattern" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M30 10 L50 30 L30 50 L10 30 Z" fill="none" stroke="currentColor" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#contact-pattern)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-6">
                    <i class="fas fa-envelope text-primary text-2xl"></i>
                </div>
                @if(isset($sections['contact']))
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-4">
                    {{ $sections['contact']->title }}
                </h2>
                <p class="text-lg text-muted-foreground max-w-3xl mx-auto">
                    {{ $sections['contact']->content }}
                </p>
                @else
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-4">{{ __('messages.contact_title') }}</h2>
                <p class="text-lg text-muted-foreground max-w-3xl mx-auto">
                    {{ __('messages.contact_content') }}
                </p>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-card rounded-xl shadow-lg p-8 border border-border">
                    <h3 class="text-xl font-semibold text-foreground mb-6 flex items-center">
                        <i class="fas fa-paper-plane text-primary mr-3"></i>
                        {{ __('messages.send_message') }}
                    </h3>

                    @if(session('success'))
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-foreground mb-2">{{ __('messages.name') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-muted-foreground text-sm"></i>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                           class="w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                           placeholder="{{ __('messages.enter_your_name') }}">
                                </div>
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-foreground mb-2">{{ __('messages.email') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-muted-foreground text-sm"></i>
                                    </div>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                           placeholder="{{ __('messages.enter_your_email') }}">
                                </div>
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-foreground mb-2">{{ __('messages.subject') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-muted-foreground text-sm"></i>
                                </div>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                       class="w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                       placeholder="{{ __('messages.enter_subject') }}">
                            </div>
                            @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-foreground mb-2">{{ __('messages.message') }}</label>
                            <textarea id="message" name="message" rows="4"
                                      class="w-full px-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                      placeholder="{{ __('messages.enter_your_message') }}">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                                class="w-full bg-primary text-primary-foreground py-3 px-6 rounded-lg hover:bg-primary/90 transition-colors font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            {{ __('messages.send') }}
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    @if(isset($sections['contact']) && isset($sections['contact']->data['phone']))
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-phone text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.phone') }}</h3>
                            <p class="text-muted-foreground">{{ $sections['contact']->data['phone'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if(isset($sections['contact']) && isset($sections['contact']->data['email']))
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-envelope text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.email') }}</h3>
                            <p class="text-muted-foreground">{{ $sections['contact']->data['email'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if(isset($sections['contact']) && isset($sections['contact']->data['address']))
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.address') }}</h3>
                            <p class="text-muted-foreground">{{ $sections['contact']->data['address'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if(isset($sections['contact']) && isset($sections['contact']->data['hours']))
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-clock text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.hours') }}</h3>
                            <p class="text-muted-foreground">{{ $sections['contact']->data['hours'] }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Emergency Contact Card -->
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-6 mt-8">
                        <div class="flex items-start">
                            <div class="bg-red-100 dark:bg-red-800/30 rounded-full w-12 h-12 flex items-center justify-center mr-4 animate-pulse">
                                <i class="fas fa-ambulance text-red-600 dark:text-red-400"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-red-800 dark:text-red-200 mb-1">{{ __('messages.emergency_contact') }}</h3>
                                <p class="text-red-700 dark:text-red-300 text-sm">{{ __('messages.emergency_contact_desc') }}</p>
                                <p class="text-red-800 dark:text-red-200 font-bold mt-2">{{ __('messages.emergency_number') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative overflow-hidden bg-card border-t border-border">
        <!-- Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-muted/20 via-background to-muted/10"></div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-10 dark:opacity-20">
            <div class="absolute top-10 left-10 w-20 h-20 bg-primary rounded-full blur-xl animate-pulse"></div>
            <div class="absolute top-32 right-20 w-16 h-16 bg-accent rounded-full blur-lg animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-secondary rounded-full blur-md animate-pulse" style="animation-delay: 4s;"></div>
            <div class="absolute bottom-32 right-1/3 w-24 h-24 bg-primary/50 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <!-- Geometric Pattern Overlay -->
        <div class="absolute inset-0 opacity-5 dark:opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="footer-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                        <path d="M 20 0 L 0 0 0 20" fill="none" stroke="currentColor" stroke-width="0.5"/>
                        <circle cx="10" cy="10" r="1" fill="currentColor" opacity="0.3"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#footer-grid)"/>
            </svg>
        </div>

        <div class="relative">
            <!-- Main Footer Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <!-- Top Section with Logo and CTA -->
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center space-x-4 mb-6">
                        @php
                            $logo = \App\Models\Setting::get('logo');
                        @endphp
                        @if($logo)
                            <img src="{{ $logo }}" alt="{{ config('app.name') }}" class="h-12 w-auto">
                        @else
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center shadow-xl">
                                <i class="fas fa-shield-alt text-primary-foreground text-xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-foreground">Globale Protect</h2>
                        @endif
                    </div>
                    <p class="text-xl text-muted-foreground max-w-2xl mx-auto leading-relaxed mb-8">
                        {{ __('messages.footer_description') }}
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="#contact" class="inline-flex items-center px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-full hover:bg-primary/90 hover:shadow-lg hover:scale-105 transition-all duration-300">
                            <i class="fas fa-phone mr-2"></i>
                            {{ __('messages.get_started_today') }}
                        </a>
                        <a href="#services" class="inline-flex items-center px-6 py-3 border border-border text-foreground font-semibold rounded-full hover:bg-secondary hover:text-secondary-foreground transition-all duration-300">
                            <i class="fas fa-arrow-right mr-2"></i>
                            {{ __('messages.learn_more') }}
                        </a>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                    <!-- Company Info -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-bold text-foreground relative">
                            {{ __('messages.company') }}
                            <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-primary"></div>
                        </h4>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3 group">
                                <div class="w-8 h-8 bg-secondary rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                                    <i class="fas fa-map-marker-alt text-muted-foreground text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-muted-foreground text-sm">{{ __('messages.head_office') }}</p>
                                    <p class="text-foreground">{{ __('messages.office_address') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 group">
                                <div class="w-8 h-8 bg-secondary rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                                    <i class="fas fa-envelope text-muted-foreground text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-muted-foreground text-sm">{{ __('messages.email') }}</p>
                                    <p class="text-foreground">{{ __('messages.company_email') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-bold text-foreground relative">
                            {{ __('messages.quick_links') }}
                            <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-primary"></div>
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="#home" class="text-muted-foreground hover:text-primary transition-colors duration-200 flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    {{ __('messages.home') }}
                                </a>
                            </li>
                            <li>
                                <a href="#about" class="text-muted-foreground hover:text-primary transition-colors duration-200 flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    {{ __('messages.about') }}
                                </a>
                            </li>
                            <li>
                                <a href="#services" class="text-muted-foreground hover:text-primary transition-colors duration-200 flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    {{ __('messages.services') }}
                                </a>
                            </li>
                            <li>
                                <a href="#contact" class="text-muted-foreground hover:text-primary transition-colors duration-200 flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    {{ __('messages.contact') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-bold text-foreground relative">
                            {{ __('messages.follow_us') }}
                            <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-primary"></div>
                        </h4>
                        <div class="flex flex-wrap gap-3">
                            <a href="#" class="w-10 h-10 bg-primary/10 hover:bg-primary rounded-lg flex items-center justify-center hover:shadow-lg hover:scale-110 transition-all duration-300 group border border-border">
                                <i class="fab fa-facebook text-primary group-hover:text-primary-foreground group-hover:animate-pulse"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-primary/10 hover:bg-primary rounded-lg flex items-center justify-center hover:shadow-lg hover:scale-110 transition-all duration-300 group border border-border">
                                <i class="fab fa-twitter text-primary group-hover:text-primary-foreground group-hover:animate-pulse"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-primary/10 hover:bg-primary rounded-lg flex items-center justify-center hover:shadow-lg hover:scale-110 transition-all duration-300 group border border-border">
                                <i class="fab fa-linkedin text-primary group-hover:text-primary-foreground group-hover:animate-pulse"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-primary/10 hover:bg-primary rounded-lg flex items-center justify-center hover:shadow-lg hover:scale-110 transition-all duration-300 group border border-border">
                                <i class="fab fa-youtube text-primary group-hover:text-primary-foreground group-hover:animate-pulse"></i>
                            </a>
                        </div>
                        <div class="text-muted-foreground text-sm">
                            <p>{{ __('messages.stay_connected') }}</p>
                            <p>{{ __('messages.emergency_updates') }}</p>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    {{-- <div class="space-y-6">
                        <h4 class="text-lg font-bold text-foreground relative">
                            Emergency
                            <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-red-500"></div>
                        </h4>
                        <div class="bg-red-600 dark:bg-red-700 p-6 rounded-2xl shadow-xl border border-red-500">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-phone text-white text-lg animate-pulse"></i>
                                </div>
                                <div>
                                    <h5 class="text-white font-bold">24/7 Emergency</h5>
                                    <p class="text-red-100 text-sm">Always Available</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white text-2xl font-bold">911</p>
                                <p class="text-red-100 text-xs mt-1">International: +1 (555) 911-0000</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-border bg-muted/30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-6">
                            <p class="text-muted-foreground text-sm">
                                © {{ date('Y') }} Globale Protect. {{ __('messages.copyright') }}
                            </p>
                            <div class="flex space-x-4 text-sm">
                                <a href="#" class="text-muted-foreground hover:text-primary transition-colors">{{ __('messages.privacy_policy') }}</a>
                                <a href="#" class="text-muted-foreground hover:text-primary transition-colors">{{ __('messages.terms_of_service') }}</a>
                                <a href="#" class="text-muted-foreground hover:text-primary transition-colors">{{ __('messages.cookies') }}</a>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-secondary hover:bg-secondary/80 text-secondary-foreground rounded-lg transition-all duration-300 group text-sm border border-border">
                            <i class="fas fa-user-shield mr-2 group-hover:animate-pulse"></i>
                            {{ __('messages.admin_login') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Emergency Button -->
    <div class="fixed bottom-6 right-6 z-40 group">
        <button class="bg-red-600 hover:bg-red-700 text-white w-14 h-14 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center animate-pulse hover:animate-none hover:scale-110">
            <i class="fas fa-phone text-xl transition-transform"></i>
        </button>
        <!-- Tooltip -->
        <div class="absolute bottom-16 right-0 bg-card border border-border rounded-lg p-3 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap pointer-events-none">
            <div class="text-center">
                <p class="text-sm font-medium text-foreground">{{ __('messages.emergency_hotline') }}</p>
                <p class="text-lg font-bold text-red-600">{{ __('messages.emergency_number') }}</p>
                <p class="text-xs text-muted-foreground">{{ __('messages.available_24_7') }}</p>
            </div>
            <!-- Arrow -->
            <div class="absolute bottom-0 right-4 transform translate-y-1/2 rotate-45 w-2 h-2 bg-card border-r border-b border-border"></div>
        </div>
    </div>

    <!-- JavaScript for mobile menu, dark mode, and language switching -->
    <script>
        // Page Loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 300);
            }, 800);
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Dark mode functionality
        function initTheme() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.contains('dark');

            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Initialize theme on page load
        initTheme();

        // Theme toggle event listeners
        document.getElementById('theme-toggle').addEventListener('click', toggleTheme);
        document.getElementById('mobile-theme-toggle').addEventListener('click', toggleTheme);

        // Language switching
        function switchLanguage(locale) {
            window.location.href = `{{ url('/lang') }}/${locale}`;
        }

        document.getElementById('language-selector').addEventListener('change', function() {
            switchLanguage(this.value);
        });

        document.getElementById('mobile-language-selector').addEventListener('change', function() {
            switchLanguage(this.value);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = document.getElementById('mobile-menu-button');

            if (!mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        // Testimonials Slider Functionality
        @if($testimonials->count() > 0)
        const testimonialsSlider = {
            currentSlide: 0,
            totalSlides: {{ $testimonials->count() }},
            slidesToShow: 1,
            track: null,
            dots: null,
            autoplayInterval: null,

            init() {
                this.track = document.querySelector('.testimonials-track');
                this.dots = document.querySelectorAll('.testimonial-dot');

                // Set slides to show based on screen size
                this.updateSlidesToShow();
                window.addEventListener('resize', () => this.updateSlidesToShow());

                // Navigation buttons
                document.getElementById('testimonials-prev').addEventListener('click', () => this.prevSlide());
                document.getElementById('testimonials-next').addEventListener('click', () => this.nextSlide());

                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });

                // Auto-play
                this.startAutoplay();

                // Pause autoplay on hover
                const slider = document.querySelector('.testimonials-slider');
                slider.addEventListener('mouseenter', () => this.stopAutoplay());
                slider.addEventListener('mouseleave', () => this.startAutoplay());

                this.updateSlider();
            },

            updateSlidesToShow() {
                if (window.innerWidth >= 1024) {
                    this.slidesToShow = 3;
                } else if (window.innerWidth >= 768) {
                    this.slidesToShow = 2;
                } else {
                    this.slidesToShow = 1;
                }
                this.updateSlider();
            },

            updateSlider() {
                if (!this.track) return;

                const slideWidth = 100 / this.slidesToShow;
                const translateX = -(this.currentSlide * slideWidth);
                this.track.style.transform = `translateX(${translateX}%)`;

                // Update dots
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.add('bg-primary');
                        dot.classList.remove('bg-muted-foreground/30');
                    } else {
                        dot.classList.remove('bg-primary');
                        dot.classList.add('bg-muted-foreground/30');
                    }
                });
            },

            nextSlide() {
                const maxSlide = Math.max(0, this.totalSlides - this.slidesToShow);
                this.currentSlide = this.currentSlide >= maxSlide ? 0 : this.currentSlide + 1;
                this.updateSlider();
            },

            prevSlide() {
                const maxSlide = Math.max(0, this.totalSlides - this.slidesToShow);
                this.currentSlide = this.currentSlide <= 0 ? maxSlide : this.currentSlide - 1;
                this.updateSlider();
            },

            goToSlide(index) {
                const maxSlide = Math.max(0, this.totalSlides - this.slidesToShow);
                this.currentSlide = Math.min(index, maxSlide);
                this.updateSlider();
            },

            startAutoplay() {
                this.stopAutoplay();
                this.autoplayInterval = setInterval(() => this.nextSlide(), 5000);
            },

            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = null;
                }
            }
        };

        // Initialize testimonials slider when DOM is loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => testimonialsSlider.init());
        } else {
            testimonialsSlider.init();
        }
        @endif

        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // Observe sections for animation
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('#home');
            if (hero) {
                const speed = scrolled * 0.5;
                hero.style.transform = `translateY(${speed}px)`;
            }
        });

        // Add floating animation to emergency elements
        const emergencyElements = document.querySelectorAll('.animate-pulse, .animate-bounce');
        emergencyElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.animationDuration = '0.3s';
            });
            element.addEventListener('mouseleave', function() {
                this.style.animationDuration = '';
            });
        });
    </script>

    <!-- Additional CSS for animations -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .testimonial-slide {
            transition: transform 0.5s ease-in-out;
        }

        .testimonials-track {
            display: flex;
        }

        /* Hover effects */
        .group:hover .group-hover\:animate-pulse {
            animation: pulse 1s infinite;
        }

        /* Smooth transitions for all interactive elements */
        * {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: hsl(var(--muted));
        }

        ::-webkit-scrollbar-thumb {
            background: hsl(var(--primary));
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: hsl(var(--primary) / 0.8);
        }
    </style>
</body>
</html>
