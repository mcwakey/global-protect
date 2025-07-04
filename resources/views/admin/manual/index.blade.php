@extends('layouts.admin')

@section('title', __('messages.user_manual'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-foreground mb-2">{{ __('messages.user_manual') }}</h1>
        <p class="text-muted-foreground">{{ __('messages.learn_how_to_use_admin_panel') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-card border border-border rounded-lg p-6 sticky top-8">
                <h3 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.table_of_contents') }}</h3>
                <nav class="space-y-2">
                    <a href="#getting-started" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.getting_started') }}</a>
                    <a href="#dashboard" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.dashboard') }}</a>
                    <a href="#sections" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.sections') }}</a>
                    <a href="#features" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.features') }}</a>
                    <a href="#testimonials" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.testimonials') }}</a>
                    <a href="#messages" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.messages') }}</a>
                    <a href="#settings" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.settings') }}</a>
                    <a href="#customization" class="block text-sm text-muted-foreground hover:text-primary transition-colors">{{ __('messages.customization') }}</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div class="bg-card border border-border rounded-lg p-8 space-y-8">
                <!-- Getting Started -->
                <section id="getting-started">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.getting_started') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.welcome_to_admin_panel') }}</p>
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">{{ __('messages.quick_start') }}</h4>
                            <ol class="list-decimal list-inside space-y-1 text-sm text-blue-700 dark:text-blue-300">
                                <li>{{ __('messages.step_1_login') }}</li>
                                <li>{{ __('messages.step_2_dashboard') }}</li>
                                <li>{{ __('messages.step_3_customize') }}</li>
                                <li>{{ __('messages.step_4_preview') }}</li>
                            </ol>
                        </div>
                    </div>
                </section>

                <!-- Dashboard -->
                <section id="dashboard">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.dashboard') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.dashboard_description') }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6">
                            <div class="bg-muted/30 rounded-lg p-4">
                                <h4 class="font-semibold text-foreground mb-2">{{ __('messages.site_overview') }}</h4>
                                <p class="text-sm text-muted-foreground">{{ __('messages.site_overview_desc') }}</p>
                            </div>
                            <div class="bg-muted/30 rounded-lg p-4">
                                <h4 class="font-semibold text-foreground mb-2">{{ __('messages.quick_actions') }}</h4>
                                <p class="text-sm text-muted-foreground">{{ __('messages.quick_actions_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Sections Management -->
                <section id="sections">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.managing_sections') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.sections_description') }}</p>

                        <h3 class="text-xl font-semibold text-foreground mb-3">{{ __('messages.creating_sections') }}</h3>
                        <ol class="list-decimal list-inside space-y-2 text-muted-foreground mb-6">
                            <li>{{ __('messages.create_section_step_1') }}</li>
                            <li>{{ __('messages.create_section_step_2') }}</li>
                            <li>{{ __('messages.create_section_step_3') }}</li>
                            <li>{{ __('messages.create_section_step_4') }}</li>
                        </ol>

                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-2">{{ __('messages.pro_tip') }}</h4>
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">{{ __('messages.sections_pro_tip') }}</p>
                        </div>
                    </div>
                </section>

                <!-- Features Management -->
                <section id="features">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.managing_features') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.features_description') }}</p>

                        <h3 class="text-xl font-semibold text-foreground mb-3">{{ __('messages.feature_icons') }}</h3>
                        <p class="text-muted-foreground mb-4">{{ __('messages.feature_icons_desc') }}</p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-6">
                            <div class="bg-muted/30 rounded-lg p-3 text-center">
                                <i class="fas fa-shield-alt text-primary text-2xl mb-2"></i>
                                <p class="text-xs text-muted-foreground">fas fa-shield-alt</p>
                            </div>
                            <div class="bg-muted/30 rounded-lg p-3 text-center">
                                <i class="fas fa-phone text-primary text-2xl mb-2"></i>
                                <p class="text-xs text-muted-foreground">fas fa-phone</p>
                            </div>
                            <div class="bg-muted/30 rounded-lg p-3 text-center">
                                <i class="fas fa-ambulance text-primary text-2xl mb-2"></i>
                                <p class="text-xs text-muted-foreground">fas fa-ambulance</p>
                            </div>
                            <div class="bg-muted/30 rounded-lg p-3 text-center">
                                <i class="fas fa-brain text-primary text-2xl mb-2"></i>
                                <p class="text-xs text-muted-foreground">fas fa-brain</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Testimonials -->
                <section id="testimonials">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.managing_testimonials') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.testimonials_description') }}</p>

                        <h3 class="text-xl font-semibold text-foreground mb-3">{{ __('messages.testimonial_best_practices') }}</h3>
                        <ul class="list-disc list-inside space-y-2 text-muted-foreground mb-6">
                            <li>{{ __('messages.testimonial_tip_1') }}</li>
                            <li>{{ __('messages.testimonial_tip_2') }}</li>
                            <li>{{ __('messages.testimonial_tip_3') }}</li>
                            <li>{{ __('messages.testimonial_tip_4') }}</li>
                        </ul>
                    </div>
                </section>

                <!-- Messages -->
                <section id="messages">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.managing_messages') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.messages_description') }}</p>

                        <h3 class="text-xl font-semibold text-foreground mb-3">{{ __('messages.message_features') }}</h3>
                        <ul class="list-disc list-inside space-y-2 text-muted-foreground mb-6">
                            <li>{{ __('messages.message_feature_1') }}</li>
                            <li>{{ __('messages.message_feature_2') }}</li>
                            <li>{{ __('messages.message_feature_3') }}</li>
                        </ul>
                    </div>
                </section>

                <!-- Settings -->
                <section id="settings">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.site_settings') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.settings_description') }}</p>

                        <h3 class="text-xl font-semibold text-foreground mb-3">{{ __('messages.logo_management') }}</h3>
                        <p class="text-muted-foreground mb-4">{{ __('messages.logo_management_desc') }}</p>

                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-green-800 dark:text-green-200 mb-2">{{ __('messages.logo_requirements') }}</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm text-green-700 dark:text-green-300">
                                <li>{{ __('messages.logo_req_1') }}</li>
                                <li>{{ __('messages.logo_req_2') }}</li>
                                <li>{{ __('messages.logo_req_3') }}</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Customization -->
                <section id="customization">
                    <h2 class="text-2xl font-bold text-foreground mb-4">{{ __('messages.customization') }}</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-muted-foreground mb-4">{{ __('messages.customization_description') }}</p>

                        <h3 class="text-xl font-semibold text-foreground mb-3">{{ __('messages.color_customization') }}</h3>
                        <p class="text-muted-foreground mb-4">{{ __('messages.color_customization_desc') }}</p>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
                            <div class="bg-muted/30 rounded-lg p-4">
                                <div class="w-8 h-8 bg-primary rounded-full mb-3"></div>
                                <h4 class="font-semibold text-foreground mb-2">{{ __('messages.primary_color') }}</h4>
                                <p class="text-sm text-muted-foreground">{{ __('messages.primary_color_desc') }}</p>
                            </div>
                            <div class="bg-muted/30 rounded-lg p-4">
                                <div class="w-8 h-8 bg-secondary rounded-full mb-3"></div>
                                <h4 class="font-semibold text-foreground mb-2">{{ __('messages.secondary_color') }}</h4>
                                <p class="text-sm text-muted-foreground">{{ __('messages.secondary_color_desc') }}</p>
                            </div>
                            <div class="bg-muted/30 rounded-lg p-4">
                                <div class="w-8 h-8 bg-accent rounded-full mb-3"></div>
                                <h4 class="font-semibold text-foreground mb-2">{{ __('messages.accent_color') }}</h4>
                                <p class="text-sm text-muted-foreground">{{ __('messages.accent_color_desc') }}</p>
                            </div>
                        </div>

                        <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-purple-800 dark:text-purple-200 mb-2">{{ __('messages.theming_tip') }}</h4>
                            <p class="text-sm text-purple-700 dark:text-purple-300">{{ __('messages.theming_tip_desc') }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Highlight active section in navigation
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a[href^="#"]');

    let currentSection = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop - 100) {
            currentSection = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('text-primary', 'font-medium');
        link.classList.add('text-muted-foreground');
        if (link.getAttribute('href') === `#${currentSection}`) {
            link.classList.remove('text-muted-foreground');
            link.classList.add('text-primary', 'font-medium');
        }
    });
});
</script>
@endsection
