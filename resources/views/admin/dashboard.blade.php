@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ __('messages.admin_dashboard') }}</h1>
            <p class="text-muted-foreground mt-1">{{ __('messages.dashboard_subtitle') }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <span class="text-sm text-muted-foreground">{{ __('messages.last_updated') }}: {{ now()->format('M j, Y H:i') }}</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <i class="fas fa-layer-group text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">{{ __('messages.sections') }}</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['sections'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-green-600 dark:text-green-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">{{ __('messages.features') }}</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['features'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                    <i class="fas fa-quote-left text-purple-600 dark:text-purple-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">{{ __('messages.testimonials') }}</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['testimonials'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-orange-600 dark:text-orange-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">{{ __('messages.messages') }}</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['contact_messages'] }}</p>
                    @if($stats['unread_messages'] > 0)
                        <p class="text-xs text-orange-600 dark:text-orange-400">{{ $stats['unread_messages'] }} {{ __('messages.unread') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-card border border-border rounded-lg p-6">
        <h2 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.quick_actions') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.sections.create') }}"
               class="flex items-center justify-center px-4 py-3 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.add_section') }}
            </a>
            <a href="{{ route('admin.features.create') }}"
               class="flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.add_feature') }}
            </a>
            <a href="{{ route('admin.testimonials.create') }}"
               class="flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.add_testimonial') }}
            </a>
            <a href="{{ route('admin.contact-messages.index') }}"
               class="flex items-center justify-center px-4 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                <i class="fas fa-eye mr-2"></i>
                {{ __('messages.view_messages') }}
            </a>
        </div>
    </div>

    <!-- Recent Messages -->
    @if($recentMessages->count() > 0)
    <div class="bg-card border border-border rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-foreground">{{ __('messages.recent_messages') }}</h2>
            <a href="{{ route('admin.contact-messages.index') }}"
               class="text-sm text-primary hover:text-primary/80 transition-colors">
                {{ __('messages.view_all') }}
            </a>
        </div>
        <div class="space-y-4">
            @foreach($recentMessages as $message)
            <div class="flex items-start space-x-3 p-3 bg-secondary rounded-lg">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-primary-foreground text-sm font-medium">{{ substr($message->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-foreground">{{ $message->name }}</p>
                        <p class="text-xs text-muted-foreground">{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="text-sm text-muted-foreground">{{ $message->email }}</p>
                    <p class="text-sm text-foreground mt-1">{{ Str::limit($message->message, 100) }}</p>
                </div>
                @if(!$message->is_read)
                <div class="w-2 h-2 bg-orange-500 rounded-full flex-shrink-0"></div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Site Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-card border border-border rounded-lg p-6">
            <h2 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.site_overview') }}</h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">{{ __('messages.total_sections') }}</span>
                    <span class="text-sm font-medium text-foreground">{{ $stats['sections'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">{{ __('messages.total_features') }}</span>
                    <span class="text-sm font-medium text-foreground">{{ $stats['features'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">{{ __('messages.total_testimonials') }}</span>
                    <span class="text-sm font-medium text-foreground">{{ $stats['testimonials'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">{{ __('messages.total_messages') }}</span>
                    <span class="text-sm font-medium text-foreground">{{ $stats['contact_messages'] }}</span>
                </div>
            </div>
        </div>

        <div class="bg-card border border-border rounded-lg p-6">
            <h2 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.system_info') }}</h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">{{ __('messages.current_locale') }}</span>
                    <span class="text-sm font-medium text-foreground">{{ strtoupper(app()->getLocale()) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">{{ __('messages.theme') }}</span>
                    <span class="text-sm font-medium text-foreground" id="current-theme">{{ __('messages.system_default') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">{{ __('messages.logged_in_as') }}</span>
                    <span class="text-sm font-medium text-foreground">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update theme display
    function updateThemeDisplay() {
        const themeDisplay = document.getElementById('current-theme');
        const isDark = document.documentElement.classList.contains('dark');
        const theme = localStorage.getItem('theme');

        if (theme === 'dark') {
            themeDisplay.textContent = '{{ __('messages.dark_mode') }}';
        } else if (theme === 'light') {
            themeDisplay.textContent = '{{ __('messages.light_mode') }}';
        } else {
            themeDisplay.textContent = '{{ __('messages.system_default') }}';
        }
    }

    // Initialize theme display
    updateThemeDisplay();

    // Update theme display when theme changes
    document.getElementById('theme-toggle').addEventListener('click', function() {
        setTimeout(updateThemeDisplay, 100);
    });
</script>
@endsection
