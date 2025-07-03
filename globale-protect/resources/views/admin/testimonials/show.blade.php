@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ $testimonial->name }}</h1>
            <p class="text-muted-foreground mt-1">{{ __('messages.testimonial_details') }}</p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-2">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                {{ __('messages.edit') }}
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
               class="inline-flex items-center px-4 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('messages.back') }}
            </a>
        </div>
    </div>

    <!-- Testimonial Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-card border border-border rounded-lg p-6">
            <h2 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.basic_information') }}</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.name') }}</label>
                    <p class="text-foreground">{{ $testimonial->name }}</p>
                </div>
                @if($testimonial->position)
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.position') }}</label>
                    <p class="text-foreground">{{ $testimonial->position }}</p>
                </div>
                @endif
                @if($testimonial->company)
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.company') }}</label>
                    <p class="text-foreground">{{ $testimonial->company }}</p>
                </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.rating') }}</label>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star text-sm {{ $i <= $testimonial->rating ? 'text-yellow-500' : 'text-muted-foreground' }}"></i>
                        @endfor
                        <span class="ml-2 text-sm text-muted-foreground">{{ $testimonial->rating }}/5</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.order') }}</label>
                    <p class="text-foreground">{{ $testimonial->sort_order }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.status') }}</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $testimonial->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                        {{ $testimonial->is_active ? __('messages.active') : __('messages.inactive') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-card border border-border rounded-lg p-6">
            <h2 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.timestamps') }}</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.created_at') }}</label>
                    <p class="text-foreground">{{ $testimonial->created_at->format('M j, Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">{{ __('messages.updated_at') }}</label>
                    <p class="text-foreground">{{ $testimonial->updated_at->format('M j, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-card border border-border rounded-lg p-6">
        <h2 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.testimonial_content') }}</h2>
        <div class="prose prose-sm max-w-none dark:prose-invert">
            <blockquote class="text-lg italic text-muted-foreground border-l-4 border-primary pl-4">
                "{{ $testimonial->content }}"
            </blockquote>
        </div>
    </div>

    <!-- Image -->
    @if($testimonial->image)
    <div class="bg-card border border-border rounded-lg p-6">
        <h2 class="text-lg font-semibold text-foreground mb-4">{{ __('messages.image') }}</h2>
        <div class="flex justify-center">
            <img src="{{ Storage::url($testimonial->image) }}"
                 alt="{{ $testimonial->name }}"
                 class="w-32 h-32 object-cover rounded-full shadow-lg">
        </div>
    </div>
    @endif

    <!-- Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-border">
        <div class="flex space-x-3">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
               class="inline-flex items-center px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                {{ __('messages.edit_testimonial') }}
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
               class="inline-flex items-center px-6 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors">
                {{ __('messages.back_to_testimonials') }}
            </a>
        </div>
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
    </div>
</div>
@endsection
