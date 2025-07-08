@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">
                {{ isset($feature) ? __('messages.edit_feature') : __('messages.add_feature') }}
            </h1>
            <p class="text-muted-foreground mt-1">
                {{ isset($feature) ? __('messages.edit_feature_subtitle') : __('messages.add_feature_subtitle') }}
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.features.index') }}"
               class="inline-flex items-center px-4 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('messages.back_to_features') }}
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-card border border-border rounded-lg p-6">
        <form action="{{ isset($feature) ? route('admin.features.update', $feature) : route('admin.features.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @if(isset($feature))
                @method('PUT')
            @endif

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $feature->title ?? '') }}"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="icon" class="block text-sm font-medium text-foreground mb-2">
                        {{ __('messages.icon') }} <span class="text-muted-foreground text-xs">(Font Awesome class)</span>
                    </label>
                    <input type="text"
                           id="icon"
                           name="icon"
                           value="{{ old('icon', $feature->icon ?? '') }}"
                           class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="fas fa-star">
                    @error('icon')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-foreground mb-2">
                    {{ __('messages.description') }} <span class="text-red-500">*</span>
                </label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                          required>{{ old('description', $feature->description ?? '') }}</textarea>
                @error('description')
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
                    @if(isset($feature) && $feature->image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($feature->image) }}"
                                 alt="{{ $feature->title }}"
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
                           value="{{ old('sort_order', $feature->sort_order ?? 0) }}"
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
                               {{ old('is_active', $feature->is_active ?? true) ? 'checked' : '' }}
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
                        {{ isset($feature) ? __('messages.update_feature') : __('messages.create_feature') }}
                    </button>
                    <a href="{{ route('admin.features.index') }}"
                       class="inline-flex items-center px-6 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </div>
        </form>

        @if(isset($feature))
        <!-- Delete Form (separate from main form) -->
        <div class="mt-6 pt-6 border-t border-border flex justify-end">
            <form action="{{ route('admin.features.destroy', $feature) }}"
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
