@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">
                {{ isset($testimonial) ? __('messages.edit_testimonial') : __('messages.add_testimonial') }}
            </h1>
            <p class="text-muted-foreground mt-1">
                {{ isset($testimonial) ? __('messages.edit_testimonial_subtitle') : __('messages.add_testimonial_subtitle') }}
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.testimonials.index') }}"
               class="inline-flex items-center px-4 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('messages.back_to_testimonials') }}
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-card border border-border rounded-lg p-6">
        <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @if(isset($testimonial))
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
                           value="{{ old('name', $testimonial->name ?? '') }}"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.position') }}
                    </label>
                    <input type="text"
                           id="position"
                           name="position"
                           value="{{ old('position', $testimonial->position ?? '') }}"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('position')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Company and Rating -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="company" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.company') }}
                    </label>
                    <input type="text"
                           id="company"
                           name="company"
                           value="{{ old('company', $testimonial->company ?? '') }}"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('company')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rating" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.rating') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="rating"
                            name="rating"
                            class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            required>
                        <option value="">{{ __('messages.select_rating') }}</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i == 1 ? __('messages.star') : __('messages.stars') }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-foreground mb-2">
                    {{ __('messages.content') }} <span class="text-red-500">*</span>
                </label>
                <textarea id="content"
                          name="content"
                          rows="6"
                          class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                          required>{{ old('content', $testimonial->content ?? '') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
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
                    @if(isset($testimonial) && $testimonial->image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($testimonial->image) }}"
                                 alt="{{ $testimonial->name }}"
                                 class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-foreground mb-2">
                            {{ __('messages.order') }}
                        </label>
                        <input type="number"
                               id="sort_order"
                               name="sort_order"
                               value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}"
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
                               {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
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
                        {{ isset($testimonial) ? __('messages.update_testimonial') : __('messages.create_testimonial') }}
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}"
                       class="inline-flex items-center px-6 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
                @if(isset($testimonial))
                <div class="mt-4 sm:mt-0">
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}"
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
        </form>
    </div>
</div>
@endsection
