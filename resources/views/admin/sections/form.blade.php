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

                <div>
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
@endsection
