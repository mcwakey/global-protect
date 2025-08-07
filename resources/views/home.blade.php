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

        /* Text Shadow Classes for Better Readability */
        .text-shadow-outline {
            text-shadow:
                -1px -1px 0 rgba(0, 0, 0, 0.8),
                1px -1px 0 rgba(0, 0, 0, 0.8),
                -1px 1px 0 rgba(0, 0, 0, 0.8),
                1px 1px 0 rgba(0, 0, 0, 0.8),
                0 0 8px rgba(0, 0, 0, 0.6);
        }

        .text-shadow-soft {
            text-shadow:
                0 1px 3px rgba(0, 0, 0, 0.8),
                0 0 6px rgba(0, 0, 0, 0.4);
        }

        /* Dark mode specific text shadows */
        @media (prefers-color-scheme: dark) {
            .text-shadow-outline {
                text-shadow:
                    -1px -1px 0 rgba(0, 0, 0, 0.9),
                    1px -1px 0 rgba(0, 0, 0, 0.9),
                    -1px 1px 0 rgba(0, 0, 0, 0.9),
                    1px 1px 0 rgba(0, 0, 0, 0.9),
                    0 0 10px rgba(0, 0, 0, 0.8);
            }

            .text-shadow-soft {
                text-shadow:
                    0 2px 4px rgba(0, 0, 0, 0.9),
                    0 0 8px rgba(0, 0, 0, 0.6);
            }
        }
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
                    <a href="#home" class="text-muted-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.home') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#about" class="text-muted-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.about') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#services" class="text-muted-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.services') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#testimonials" class="text-muted-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.testimonials') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="text-muted-foreground hover:text-primary transition-all duration-200 relative group">
                        {{ __('messages.contact') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-200 group-hover:w-full"></span>
                    </a>

                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-md hover:bg-secondary transition-all duration-200 hover:scale-110">
                        <i class="fas fa-moon text-muted-foreground dark:hidden"></i>
                        <i class="fas fa-sun text-muted-foreground hidden dark:block"></i>
                    </button>

                    <!-- Language Switcher -->
                    <div class="relative">
                        <button id="language-toggle" type="button" aria-haspopup="true" aria-expanded="false" class="flex items-center space-x-2 text-muted-foreground hover:text-primary transition-colors focus:outline-none">
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
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const langToggle = document.getElementById('language-toggle');
                            const langMenu = document.getElementById('language-menu');

                            if (langToggle && langMenu) {
                                langToggle.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    langMenu.classList.toggle('hidden');
                                    langToggle.setAttribute('aria-expanded', langMenu.classList.contains('hidden') ? 'false' : 'true');
                                });

                                document.addEventListener('click', function(e) {
                                    if (!langMenu.classList.contains('hidden')) {
                                        langMenu.classList.add('hidden');
                                        langToggle.setAttribute('aria-expanded', 'false');
                                    }
                                });

                                langMenu.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                });
                            }
                        });
                    </script>
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
    </nav>    <!-- Hero Slider Section -->
    @if(isset($sections['hero']))
    <section id="home" class="relative overflow-hidden">
        <!-- Hero Slider -->
        <div class="hero-slider">
            <div class="hero-slides flex transition-transform duration-700 ease-in-out">
                @php
                    $heroSlides = $sections['hero']->data['slides'] ?? [];
                    $autoplay = $sections['hero']->data['settings']['autoplay'] ?? true;
                    $autoplayInterval = $sections['hero']->data['settings']['autoplay_interval'] ?? 5;
                @endphp

                @if(!empty($heroSlides))
                    @foreach($heroSlides as $index => $slide)
                    <div class="hero-slide flex-shrink-0 w-full bg-gradient-to-r from-primary via-primary to-primary/80 text-primary-foreground relative">
                        <!-- Background Image -->
                        @if(!empty($slide['image']))
                        <div class="absolute inset-0 z-0">
                            <img src="{{ Storage::url($slide['image']) }}"
                                 alt="Slide {{ $index + 1 }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-primary/70"></div>
                        </div>
                        @else
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <pattern id="hero-grid-{{ $index }}" width="10" height="10" patternUnits="userSpaceOnUse">
                                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                                    </pattern>
                                </defs>
                                <rect width="100%" height="100%" fill="url(#hero-grid-{{ $index }})"/>
                            </svg>
                        </div>
                        @endif

                        <!-- Hero Content -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 relative z-10">
                            <div class="text-center lg:text-left">
                                @if(!empty($slide['subtitle']))
                                <div class="inline-block bg-primary-foreground/10 backdrop-blur-sm text-primary-foreground px-3 py-1 rounded-full text-sm font-medium mb-4 border border-primary-foreground/20 text-shadow-soft">
                                    {{ $slide['subtitle'] }}
                                </div>
                                @endif

                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight text-shadow-outline">
                                    {{ $slide['title'] ?: $sections['hero']->title }}
                                </h1>

                                <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 opacity-95 leading-relaxed max-w-2xl text-shadow-soft">
                                    {{ $slide['content'] ?: $sections['hero']->content }}
                                </p>

                                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                    @if(!empty($slide['cta_text']) && !empty($slide['cta_link']))
                                    <a href="{{ $slide['cta_link'] }}"
                                       class="bg-primary-foreground text-primary px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-primary-foreground/90 transition-all duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        {{ $slide['cta_text'] }}
                                    </a>
                                    @else
                                    <a href="#about"
                                       class="bg-primary-foreground text-primary px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-primary-foreground/90 transition-all duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        {{ __('messages.learn_more') }}
                                    </a>
                                    @endif
                                    <a href="#contact"
                                       class="border border-primary-foreground text-primary-foreground px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-primary-foreground/10 transition-all duration-300 inline-block">
                                        {{ __('messages.contact') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Fallback slide if no data -->
                    <div class="hero-slide flex-shrink-0 w-full bg-gradient-to-r from-primary via-primary to-primary/80 text-primary-foreground relative">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <pattern id="hero-grid-fallback" width="10" height="10" patternUnits="userSpaceOnUse">
                                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                                    </pattern>
                                </defs>
                                <rect width="100%" height="100%" fill="url(#hero-grid-fallback)"/>
                            </svg>
                        </div>

                        <!-- Hero Content -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 relative z-10">
                            <div class="text-center lg:text-left">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight text-shadow-outline">
                                    {{ $sections['hero']->title }}
                                </h1>
                                <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 opacity-95 leading-relaxed text-shadow-soft">
                                    {{ $sections['hero']->content }}
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
                        </div>
                    </div>
                @endif


                <!-- Slide 2 - Emergency Response Focus -->
                <div class="hero-slide flex-shrink-0 w-full bg-gradient-to-r from-red-600 via-red-500 to-orange-500 text-white relative">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="hero-grid-2" width="15" height="15" patternUnits="userSpaceOnUse">
                                    <circle cx="7.5" cy="7.5" r="1" fill="white"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#hero-grid-2)"/>
                        </svg>
                    </div>

                    <!-- Emergency Icon -->
                    <div class="absolute top-1/4 right-10 w-32 h-32 lg:w-48 lg:h-48 opacity-20 hidden lg:block">
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-ambulance text-white text-8xl animate-pulse"></i>
                        </div>
                    </div>

                    <!-- Hero Content -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 relative">
                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                            <!-- Left Side - Text Content -->
                            <div class="text-center lg:text-left">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight text-shadow-outline">
                                    Emergency Response Excellence
                                </h1>
                                <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 opacity-95 leading-relaxed text-shadow-soft">
                                    Advanced emergency management systems that reduce response times and coordinate rescue operations seamlessly.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                    <a href="#services"
                                       class="bg-white text-red-600 px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        Our Solutions
                                    </a>
                                    <a href="#contact"
                                       class="border border-white text-white px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 inline-block">
                                        Contact Us
                                    </a>
                                </div>
                            </div>

                            <!-- Right Side - Emergency Stats -->
                            <div class="relative">
                                <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm">
                                    <h3 class="text-2xl font-bold mb-6 text-center">Emergency Statistics</h3>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="bg-white/20 rounded-lg p-4 text-center">
                                            <div class="text-3xl font-bold">< 3 min</div>
                                            <div class="text-sm opacity-90">Average Response Time</div>
                                        </div>
                                        <div class="bg-white/20 rounded-lg p-4 text-center">
                                            <div class="text-3xl font-bold">99.8%</div>
                                            <div class="text-sm opacity-90">System Uptime</div>
                                        </div>
                                        <div class="bg-white/20 rounded-lg p-4 text-center">
                                            <div class="text-3xl font-bold">24/7</div>
                                            <div class="text-sm opacity-90">Emergency Support</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 - Technology Innovation -->
                <div class="hero-slide flex-shrink-0 w-full bg-gradient-to-r from-blue-600 via-blue-500 to-purple-600 text-white relative">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="hero-grid-3" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <path d="M10 0 L20 10 L10 20 L0 10 Z" fill="none" stroke="white" stroke-width="0.5"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#hero-grid-3)"/>
                        </svg>
                    </div>

                    <!-- Technology Icon -->
                    <div class="absolute top-1/4 right-10 w-32 h-32 lg:w-48 lg:h-48 opacity-20 hidden lg:block">
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-satellite-dish text-white text-8xl animate-pulse"></i>
                        </div>
                    </div>

                    <!-- Hero Content -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 relative">
                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                            <!-- Left Side - Text Content -->
                            <div class="text-center lg:text-left">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight text-shadow-outline">
                                    Cutting-Edge Technology
                                </h1>
                                <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 opacity-95 leading-relaxed text-shadow-soft">
                                    AI-powered dispatch systems, real-time communication platforms, and advanced analytics for optimal emergency management.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                    <a href="#about"
                                       class="bg-white text-blue-600 px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        Learn More
                                    </a>
                                    <a href="#services"
                                       class="border border-white text-white px-6 sm:px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 inline-block">
                                        View Features
                                    </a>
                                </div>
                            </div>

                            <!-- Right Side - Tech Features -->
                            <div class="relative">
                                <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm">
                                    <h3 class="text-2xl font-bold mb-6 text-center">Tech Features</h3>
                                    <div class="space-y-4">
                                        <div class="flex items-center space-x-3 bg-white/20 p-3 rounded-lg">
                                            <i class="fas fa-robot text-2xl"></i>
                                            <span>AI-Powered Dispatch</span>
                                        </div>
                                        <div class="flex items-center space-x-3 bg-white/20 p-3 rounded-lg">
                                            <i class="fas fa-satellite text-2xl"></i>
                                            <span>Real-time Communication</span>
                                        </div>
                                        <div class="flex items-center space-x-3 bg-white/20 p-3 rounded-lg">
                                            <i class="fas fa-chart-line text-2xl"></i>
                                            <span>Advanced Analytics</span>
                                        </div>
                                        <div class="flex items-center space-x-3 bg-white/20 p-3 rounded-lg">
                                            <i class="fas fa-mobile-alt text-2xl"></i>
                                            <span>Mobile Command Center</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button id="hero-prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-sm z-10">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="hero-next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-sm z-10">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Dots Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
                @if(!empty($heroSlides))
                    @foreach($heroSlides as $index => $slide)
                    <button class="hero-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/30' }} hover:bg-white transition-all duration-300" data-slide="{{ $index }}"></button>
                    @endforeach
                @else
                    <button class="hero-dot w-3 h-3 rounded-full bg-white hover:bg-white transition-all duration-300" data-slide="0"></button>
                @endif
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
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight text-shadow-outline">
                        {{ __('messages.hero_title') }}
                    </h1>
                    <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 opacity-95 leading-relaxed text-shadow-soft">
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
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-foreground mb-4 sm:mb-6">
                    {{ $sections['about']->title }}
                </h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                @if($sections['about']->image)
                <div class="flex-shrink-0 w-full max-w-xs mx-auto lg:mx-0">
                    <img src="{{ Storage::url($sections['about']->image) }}" alt="{{ $sections['about']->title }}" class="rounded-2xl shadow-xl object-cover w-full h-64 lg:h-80">
                </div>
                @endif
                <div>
                    <p class="text-base sm:text-lg lg:text-xl text-muted-foreground max-w-4xl mx-auto leading-relaxed mb-8">
                        {{ $sections['about']->content }}
                    </p>
                    @if(isset($sections['about']->data['values']))
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 lg:gap-12">
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
            </div>
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
                        @if($feature->image)
                            <div class="rounded-full w-14 h-14 sm:w-20 sm:h-20 flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0 overflow-hidden bg-primary/10 dark:bg-primary/20 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300">
                                <img src="{{ Storage::url($feature->image) }}" alt="{{ $feature->title }}" class="object-cover w-full h-full">
                            </div>
                        @else
                            <div class="bg-primary/10 dark:bg-primary/20 rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0 group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition-all duration-300">
                                <i class="{{ $feature->icon }} text-primary text-lg sm:text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg sm:text-xl font-semibold text-card-foreground mb-2 leading-tight">
                                {{ $feature->title }}
                            </h3>
                        </div>
                    </div>
                    <p class="text-sm sm:text-base text-muted-foreground mb-4 leading-relaxed">
                        {{ $feature->description }}
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
                    @if($settings['contact_phone'])
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-phone text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.phone') }}</h3>
                            <p class="text-muted-foreground">{{ $settings['contact_phone'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if($settings['contact_email'])
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-envelope text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.email') }}</h3>
                            <p class="text-muted-foreground">{{ $settings['contact_email'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if($settings['contact_address'])
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.address') }}</h3>
                            <p class="text-muted-foreground">{{ $settings['contact_address'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if($settings['contact_hours'])
                    <div class="flex items-start group">
                        <div class="bg-primary/10 rounded-full w-12 h-12 flex items-center justify-center mr-4 mt-1 group-hover:bg-primary/20 transition-colors">
                            <i class="fas fa-clock text-primary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1">{{ __('messages.hours') }}</h3>
                            <p class="text-muted-foreground">{{ $settings['contact_hours'] }}</p>
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
                                <p class="text-red-800 dark:text-red-200 font-bold mt-2">{{ $settings['emergency_number'] }}</p>
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
                                    <p class="text-foreground">{{ $settings['contact_address'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 group">
                                <div class="w-8 h-8 bg-secondary rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                                    <i class="fas fa-envelope text-muted-foreground text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-muted-foreground text-sm">{{ __('messages.email') }}</p>
                                    <p class="text-foreground">{{ $settings['contact_email'] }}</p>
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
                                @foreach(\App\Models\LegalPage::where('is_active', true)->get() as $legalPage)
                                <a href="{{ route('legal.show', $legalPage->type) }}" class="text-muted-foreground hover:text-primary transition-colors">{{ $legalPage->title }}</a>
                                @endforeach
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
        <button id="emergency-button" class="bg-red-600 hover:bg-red-700 text-white w-14 h-14 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center animate-pulse hover:animate-none hover:scale-110 emergency-pulse" onclick="handleEmergencyCall()" title="Emergency Call - Click for help">
            <i class="fas fa-phone text-xl transition-transform group-hover:rotate-12"></i>
        </button>
        <!-- Tooltip -->
        <div class="absolute bottom-16 right-0 bg-card border border-border rounded-lg p-3 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap pointer-events-none">
            <div class="text-center">
                <p class="text-sm font-medium text-foreground">{{ __('messages.emergency_hotline') }}</p>
                <p class="text-lg font-bold text-red-600">{{ $settings['emergency_hotline'] ?? $settings['emergency_number'] }}</p>
                <p class="text-xs text-muted-foreground">{{ __('messages.available_24_7') }}</p>
                <p class="text-xs text-muted-foreground mt-1">Click to call</p>
            </div>
            <!-- Arrow -->
            <div class="absolute bottom-0 right-4 transform translate-y-1/2 rotate-45 w-2 h-2 bg-card border-r border-b border-border"></div>
        </div>
    </div>

    <!-- Emergency Modal -->
    <div id="emergency-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 invisible transition-all duration-300">
        <div class="bg-card border border-border rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl transform scale-95 transition-all duration-300">
            <div class="text-center">
                <!-- Emergency Icon -->
                <div class="w-20 h-20 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-3xl"></i>
                </div>

                <h3 class="text-2xl font-bold text-foreground mb-4">Emergency Contact</h3>
                <p class="text-muted-foreground mb-8">Choose how you'd like to contact emergency services</p>

                <!-- Emergency Options -->
                <div class="space-y-4">
                    <!-- Primary Emergency Call -->
                    <a href="tel:{{ $settings['emergency_number'] ?? '911' }}"
                       class="w-full bg-red-600 hover:bg-red-700 text-white py-4 px-6 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 flex items-center justify-center group">
                        <i class="fas fa-phone mr-3 group-hover:animate-pulse"></i>
                        Call {{ $settings['emergency_number'] ?? '911' }}
                    </a>

                    <!-- Secondary Emergency Hotline -->
                    @if($settings['emergency_hotline'] && $settings['emergency_hotline'] != $settings['emergency_number'])
                    <a href="tel:{{ $settings['emergency_hotline'] }}"
                       class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 px-6 rounded-xl font-medium transition-all duration-300 hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-headset mr-3"></i>
                        Emergency Hotline: {{ $settings['emergency_hotline'] }}
                    </a>
                    @endif

                    <!-- SMS Option -->
                    <a href="sms:{{ $settings['emergency_number'] ?? '911' }}"
                       class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-xl font-medium transition-all duration-300 hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-comment-medical mr-3"></i>
                        Send Emergency SMS
                    </a>

                    <!-- Location Services -->
                    <button onclick="shareLocation()"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-xl font-medium transition-all duration-300 hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-map-marker-alt mr-3"></i>
                        Share My Location
                    </button>
                </div>

                <!-- Close Button -->
                <button onclick="closeEmergencyModal()"
                        class="mt-6 w-full bg-muted hover:bg-muted/80 text-muted-foreground py-2 px-4 rounded-lg transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript for mobile menu, dark mode, and language switching -->
    <script>
        // Page Loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            if (loader) {
                setTimeout(() => {
                    loader.style.opacity = '0';
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 300);
                }, 800);
            }
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

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
        const themeToggle = document.getElementById('theme-toggle');
        const mobileThemeToggle = document.getElementById('mobile-theme-toggle');

        if (themeToggle) {
            themeToggle.addEventListener('click', toggleTheme);
        }
        if (mobileThemeToggle) {
            mobileThemeToggle.addEventListener('click', toggleTheme);
        }

        // Language switching
        function switchLanguage(locale) {
            window.location.href = `{{ url('/lang') }}/${locale}`;
        }

        const languageSelector = document.getElementById('language-selector');
        const mobileLanguageSelector = document.getElementById('mobile-language-selector');

        if (languageSelector) {
            languageSelector.addEventListener('change', function() {
                switchLanguage(this.value);
            });
        }

        if (mobileLanguageSelector) {
            mobileLanguageSelector.addEventListener('change', function() {
                switchLanguage(this.value);
            });
        }

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

            if (mobileMenu && menuButton && !mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
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
                const prevBtn = document.getElementById('testimonials-prev');
                const nextBtn = document.getElementById('testimonials-next');

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => this.prevSlide());
                }
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => this.nextSlide());
                }

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

        // Hero Slider Functionality
        const heroSlider = {
            currentSlide: 0,
            totalSlides: {{ !empty($heroSlides) ? count($heroSlides) : 3 }},
            track: null,
            dots: null,
            autoplayInterval: null,
            autoplayEnabled: {{ json_encode($autoplay ?? true) }},
            autoplayDelay: {{ ($autoplayInterval ?? 5) * 1000 }},

            init() {
                this.track = document.querySelector('.hero-slides');
                this.dots = document.querySelectorAll('.hero-dot');

                if (!this.track) return;

                // Navigation buttons
                const prevBtn = document.getElementById('hero-prev');
                const nextBtn = document.getElementById('hero-next');

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => this.prevSlide());
                }
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => this.nextSlide());
                }

                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });

                // Auto-play (only if enabled)
                if (this.autoplayEnabled) {
                    this.startAutoplay();

                    // Pause autoplay on hover
                    const heroSection = document.querySelector('.hero-slider');
                    if (heroSection) {
                        heroSection.addEventListener('mouseenter', () => this.stopAutoplay());
                        heroSection.addEventListener('mouseleave', () => this.startAutoplay());
                    }
                }

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        this.prevSlide();
                    } else if (e.key === 'ArrowRight') {
                        this.nextSlide();
                    }
                });

                this.updateSlider();
            },

            updateSlider() {
                if (!this.track) return;

                // Calculate the exact translate percentage
                // Since container is 300% wide and each slide is 33.333% of that
                // To move one slide, we need to translate by 33.333% of the container
                const translateX = -(this.currentSlide * 33.333);
                this.track.style.transform = `translateX(${translateX}%)`;

                // Update dots
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.add('bg-white');
                        dot.classList.remove('bg-white/30', 'bg-white/50');
                    } else {
                        dot.classList.remove('bg-white');
                        dot.classList.add('bg-white/30');
                    }
                });
            },

            nextSlide() {
                this.currentSlide = this.currentSlide >= this.totalSlides - 1 ? 0 : this.currentSlide + 1;
                this.updateSlider();
            },

            prevSlide() {
                this.currentSlide = this.currentSlide <= 0 ? this.totalSlides - 1 : this.currentSlide - 1;
                this.updateSlider();
            },

            goToSlide(index) {
                this.currentSlide = index;
                this.updateSlider();
            },

            startAutoplay() {
                this.stopAutoplay();
                this.autoplayInterval = setInterval(() => this.nextSlide(), this.autoplayDelay);
            },

            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = null;
                }
            }
        };

        // Initialize hero slider when DOM is loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => heroSlider.init());
        } else {
            heroSlider.init();
        }

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

        // Parallax effect for non-slider sections
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('#home');
            // Disable parallax for hero slider
            if (hero && !hero.querySelector('.hero-slider')) {
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

        // Emergency Button Functionality
        function handleEmergencyCall() {
            // Check if device supports tel: links (mobile devices)
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

            if (isMobile) {
                // On mobile, show modal with options
                showEmergencyModal();
            } else {
                // On desktop, show modal with options
                showEmergencyModal();
            }
        }

        function showEmergencyModal() {
            const modal = document.getElementById('emergency-modal');
            if (modal) {
                modal.classList.remove('opacity-0', 'invisible');
                modal.querySelector('.bg-card').classList.remove('scale-95');
                modal.querySelector('.bg-card').classList.add('scale-100');

                // Prevent background scrolling
                document.body.style.overflow = 'hidden';

                // Add escape key listener
                document.addEventListener('keydown', handleEscapeKey);
            }
        }

        function closeEmergencyModal() {
            const modal = document.getElementById('emergency-modal');
            if (modal) {
                modal.classList.add('opacity-0', 'invisible');
                modal.querySelector('.bg-card').classList.add('scale-95');
                modal.querySelector('.bg-card').classList.remove('scale-100');

                // Restore background scrolling
                document.body.style.overflow = '';

                // Remove escape key listener
                document.removeEventListener('keydown', handleEscapeKey);
            }
        }

        function handleEscapeKey(event) {
            if (event.key === 'Escape') {
                closeEmergencyModal();
            }
        }

        function shareLocation() {
            if (navigator.geolocation) {
                // Add loading state
                const button = event.target;
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Getting location...';
                button.disabled = true;

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const accuracy = position.coords.accuracy;

                        // Create emergency message with location
                        const message = `EMERGENCY: I need help at coordinates ${lat}, ${lng} (accuracy: ${Math.round(accuracy)}m). Maps link: https://maps.google.com/?q=${lat},${lng}`;

                        // Open SMS with location
                        window.open(`sms:{{ $settings['emergency_number'] ?? '911' }}?body=${encodeURIComponent(message)}`);

                        // Also copy to clipboard
                        navigator.clipboard.writeText(message).then(() => {
                            alert('Location copied to clipboard and SMS opened!');
                        });

                        // Restore button
                        button.innerHTML = originalText;
                        button.disabled = false;

                        // Close modal after action
                        setTimeout(() => closeEmergencyModal(), 1000);
                    },
                    function(error) {
                        alert('Unable to get location: ' + error.message);

                        // Restore button
                        button.innerHTML = originalText;
                        button.disabled = false;
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 60000
                    }
                );
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('emergency-modal');
            const modalContent = modal?.querySelector('.bg-card');

            if (modal && !modal.classList.contains('invisible') && !modalContent?.contains(event.target)) {
                closeEmergencyModal();
            }
        });

        // Add vibration for emergency button (mobile devices)
        document.getElementById('emergency-button')?.addEventListener('click', function() {
            if (navigator.vibrate) {
                navigator.vibrate([200, 100, 200]); // Vibration pattern
            }
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

        /* Hero Slider Styles */
        .hero-slider {
            position: relative;
            overflow: hidden;
            height: 100vh;
            min-height: 600px;
        }

        .hero-slides {
            display: flex;
            width: 300%; /* 3 slides */
            height: 100%;
            transition: transform 0.7s ease-in-out;
        }

        .hero-slide {
            flex: 0 0 calc(100% / 3); /* Each slide takes exactly 1/3 of the 300% container */
            width: calc(100% / 3);
            height: 100%;
            display: flex;
            align-items: center;
            min-width: 0; /* Prevent flex item from growing beyond its basis */
            position: relative;
        }

        .hero-dot {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hero-dot:hover {
            transform: scale(1.2);
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

        /* Navigation button hover effects */
        #hero-prev, #hero-next {
            transition: all 0.3s ease;
        }

        #hero-prev:hover, #hero-next:hover {
            transform: scale(1.1);
            background-color: rgba(255, 255, 255, 0.4);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-slider {
                height: 100vh;
                min-height: 500px;
            }

            #hero-prev, #hero-next {
                width: 40px;
                height: 40px;
            }
        }

        /* Emergency Modal Styles */
        #emergency-modal.show {
            opacity: 1 !important;
            visibility: visible !important;
        }

        #emergency-modal .bg-card {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        #emergency-modal.show .bg-card {
            transform: scale(1) !important;
        }

        /* Emergency button enhanced styles */
        #emergency-button {
            position: relative;
            overflow: hidden;
        }

        #emergency-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        #emergency-button:active::before {
            width: 300px;
            height: 300px;
        }

        /* Pulse animation for emergency elements */
        .emergency-pulse {
            animation: emergency-pulse 2s infinite;
        }

        @keyframes emergency-pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        /* Loading spinner */
        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Modal backdrop blur effect */
        #emergency-modal {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Button hover effects for emergency modal */
        #emergency-modal button:hover,
        #emergency-modal a:hover {
            transform: translateY(-2px);
        }

        /* Mobile specific styles */
        @media (max-width: 768px) {
            #emergency-modal .bg-card {
                margin: 1rem;
                padding: 2rem;
            }

            #emergency-button {
                width: 60px;
                height: 60px;
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
</body>
</html>
