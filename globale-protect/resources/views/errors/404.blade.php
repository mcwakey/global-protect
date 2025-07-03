<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Page Not Found | {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground transition-colors duration-300">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 text-center">
            <!-- 404 Illustration -->
            <div class="relative">
                <div class="w-48 h-48 mx-auto mb-8 relative">
                    <div class="absolute inset-0 bg-primary/10 rounded-full animate-pulse"></div>
                    <div class="absolute inset-4 bg-primary/20 rounded-full animate-pulse delay-75"></div>
                    <div class="absolute inset-8 bg-primary/30 rounded-full animate-pulse delay-150"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-6xl font-bold text-primary mb-2">404</div>
                            <i class="fas fa-exclamation-triangle text-primary text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="space-y-4">
                <h1 class="text-3xl font-bold text-foreground">
                    {{ __('messages.page_not_found') }}
                </h1>
                <p class="text-lg text-muted-foreground">
                    {{ __('messages.page_not_found_description') }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-primary-foreground bg-primary hover:bg-primary/90 transition-colors duration-200 shadow-lg">
                    <i class="fas fa-home mr-2"></i>
                    {{ __('messages.go_home') }}
                </a>
                <button onclick="history.back()"
                        class="inline-flex items-center justify-center px-6 py-3 border border-border text-base font-medium rounded-lg text-foreground bg-secondary hover:bg-secondary/80 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('messages.go_back') }}
                </button>
            </div>

            <!-- Additional Help -->
            <div class="pt-8 border-t border-border">
                <p class="text-sm text-muted-foreground">
                    {{ __('messages.need_help') }}
                    <a href="#contact" class="text-primary hover:text-primary/80 font-medium">
                        {{ __('messages.contact_support') }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Theme initialization
        function initTheme() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.classList.toggle('dark', theme === 'dark');
        }

        // Initialize theme on page load
        initTheme();
    </script>
</body>
</html>
