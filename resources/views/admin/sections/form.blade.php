@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">
                {{ isset($section) ? __('messages.edit_section') : __('messages.add_section') }}
            </h1>
            <p class="text-muted-foreground mt-1">
                {{ isset($section) ? __('messages.edit_section_subtitle') : __('messages.add_section_subtitle') }}
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.sections.index') }}"
               class="inline-flex items-center px-4 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('messages.back_to_sections') }}
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-card border border-border rounded-lg p-6">
        <form action="{{ isset($section) ? route('admin.sections.update', $section) : route('admin.sections.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @if(isset($section))
                @method('PUT')
            @endif

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $section->name ?? '') }}"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.type') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="type"
                            name="type"
                            class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            required>
                        <option value="">{{ __('messages.select_type') }}</option>
                        <option value="hero" {{ old('type', $section->type ?? '') == 'hero' ? 'selected' : '' }}>{{ __('messages.hero') }}</option>
                        <option value="about" {{ old('type', $section->type ?? '') == 'about' ? 'selected' : '' }}>{{ __('messages.about') }}</option>
                        <option value="services" {{ old('type', $section->type ?? '') == 'services' ? 'selected' : '' }}>{{ __('messages.services') }}</option>
                        <option value="features" {{ old('type', $section->type ?? '') == 'features' ? 'selected' : '' }}>{{ __('messages.features') }}</option>
                        <option value="testimonials" {{ old('type', $section->type ?? '') == 'testimonials' ? 'selected' : '' }}>{{ __('messages.testimonials') }}</option>
                        <option value="contact" {{ old('type', $section->type ?? '') == 'contact' ? 'selected' : '' }}>{{ __('messages.contact') }}</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Title and Content -->
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $section->title ?? '') }}"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div id="regular-content">
                    <label for="content" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.content') }}
                    </label>
                    <textarea id="content"
                              name="content"
                              rows="6"
                              class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                              placeholder="{{ __('messages.content_placeholder') }}">{{ old('content', $section->content ?? '') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hero Slider Content -->
                <div id="hero-slider-content" style="display: none;">
                    <h3 class="text-lg font-medium text-foreground mb-4">Hero Slider Slides</h3>

                    @php
                        $heroSlides = [];
                        if (isset($section) && $section->data && isset($section->data['slides'])) {
                            $heroSlides = $section->data['slides'];
                        }
                        // Ensure we have at least 3 slides
                        while (count($heroSlides) < 3) {
                            $heroSlides[] = [
                                'title' => '',
                                'subtitle' => '',
                                'content' => '',
                                'cta_text' => '',
                                'cta_link' => '',
                                'image' => ''
                            ];
                        }
                    @endphp

                    @for($i = 0; $i < 3; $i++)
                        <div class="border border-border rounded-lg p-4 mb-4">
                            <h4 class="text-md font-medium text-foreground mb-3">Slide {{ $i + 1 }}</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="slide_{{ $i }}_title" class="block text-sm font-medium text-foreground mb-2">
                                        Title
                                    </label>
                                    <input type="text"
                                           id="slide_{{ $i }}_title"
                                           name="slides[{{ $i }}][title]"
                                           value="{{ old('slides.' . $i . '.title', $heroSlides[$i]['title'] ?? '') }}"
                                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>

                                <div>
                                    <label for="slide_{{ $i }}_subtitle" class="block text-sm font-medium text-foreground mb-2">
                                        Subtitle
                                    </label>
                                    <input type="text"
                                           id="slide_{{ $i }}_subtitle"
                                           name="slides[{{ $i }}][subtitle]"
                                           value="{{ old('slides.' . $i . '.subtitle', $heroSlides[$i]['subtitle'] ?? '') }}"
                                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="slide_{{ $i }}_content" class="block text-sm font-medium text-foreground mb-2">
                                    Content
                                </label>
                                <textarea id="slide_{{ $i }}_content"
                                          name="slides[{{ $i }}][content]"
                                          rows="3"
                                          class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('slides.' . $i . '.content', $heroSlides[$i]['content'] ?? '') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="slide_{{ $i }}_cta_text" class="block text-sm font-medium text-foreground mb-2">
                                        CTA Button Text
                                    </label>
                                    <input type="text"
                                           id="slide_{{ $i }}_cta_text"
                                           name="slides[{{ $i }}][cta_text]"
                                           value="{{ old('slides.' . $i . '.cta_text', $heroSlides[$i]['cta_text'] ?? '') }}"
                                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>

                                <div>
                                    <label for="slide_{{ $i }}_cta_link" class="block text-sm font-medium text-foreground mb-2">
                                        CTA Link
                                    </label>
                                    <input type="url"
                                           id="slide_{{ $i }}_cta_link"
                                           name="slides[{{ $i }}][cta_link]"
                                           value="{{ old('slides.' . $i . '.cta_link', $heroSlides[$i]['cta_link'] ?? '') }}"
                                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="slide_{{ $i }}_image" class="block text-sm font-medium text-foreground mb-2">
                                    Background Image
                                </label>
                                <input type="file"
                                       id="slide_{{ $i }}_image"
                                       name="slides[{{ $i }}][image]"
                                       accept="image/*"
                                       class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">

                                @if(isset($heroSlides[$i]['image']) && $heroSlides[$i]['image'])
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($heroSlides[$i]['image']) }}"
                                             alt="Slide {{ $i + 1 }}"
                                             class="w-32 h-20 object-cover rounded-lg">
                                        <input type="hidden" name="slides[{{ $i }}][existing_image]" value="{{ $heroSlides[$i]['image'] }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endfor

                    <!-- Auto-play Settings -->
                    <div class="border border-border rounded-lg p-4">
                        <h4 class="text-md font-medium text-foreground mb-3">Slider Settings</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <input type="checkbox"
                                       id="autoplay"
                                       name="settings[autoplay]"
                                       value="1"
                                       {{ old('settings.autoplay', isset($section) && $section->data && isset($section->data['settings']['autoplay']) ? $section->data['settings']['autoplay'] : true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                <label for="autoplay" class="ml-2 block text-sm text-foreground">
                                    Enable Auto-play
                                </label>
                            </div>

                            <div>
                                <label for="autoplay_interval" class="block text-sm font-medium text-foreground mb-2">
                                    Auto-play Interval (seconds)
                                </label>
                                <input type="number"
                                       id="autoplay_interval"
                                       name="settings[autoplay_interval]"
                                       value="{{ old('settings.autoplay_interval', isset($section) && $section->data && isset($section->data['settings']['autoplay_interval']) ? $section->data['settings']['autoplay_interval'] : 5) }}"
                                       min="1"
                                       max="60"
                                       class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image and Settings -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="image" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.image') }}
                    </label>
                    <input type="file"
                           id="image"
                           name="image"
                           accept="image/*"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    @if(isset($section) && $section->image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($section->image) }}"
                                 alt="{{ $section->title }}"
                                 class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">                <div>
                    <label for="sort_order" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.order') }}
                    </label>
                    <input type="number"
                           id="sort_order"
                           name="sort_order"
                           value="{{ old('sort_order', $section->sort_order ?? 0) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                    <div class="flex items-center">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}
                               class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                        <label for="is_active" class="ml-2 block text-sm text-foreground">
                            {{ __('messages.active') }}
                        </label>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-border">
                <div class="flex space-x-3">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($section) ? __('messages.update_section') : __('messages.create_section') }}
                    </button>
                    <a href="{{ route('admin.sections.index') }}"
                       class="inline-flex items-center px-6 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </div>
        </form>

        @if(isset($section))
        <!-- Delete Form (separate from main form) -->
        <div class="mt-6 pt-6 border-t border-border flex justify-end">
            <form action="{{ route('admin.sections.destroy', $section) }}"
                  method="POST"
                  class="inline-block"
                  onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-trash mr-2"></i>
                    {{ __('messages.delete') }}
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const regularContent = document.getElementById('regular-content');
    const heroSliderContent = document.getElementById('hero-slider-content');

    function toggleContentFields() {
        const selectedType = typeSelect.value;

        if (selectedType === 'hero') {
            regularContent.style.display = 'none';
            heroSliderContent.style.display = 'block';
        } else {
            regularContent.style.display = 'block';
            heroSliderContent.style.display = 'none';
        }
    }

    // Initial toggle based on current value
    toggleContentFields();

    // Toggle on change
    typeSelect.addEventListener('change', toggleContentFields);
});
</script>
@endsection
