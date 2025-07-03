@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ __('messages.testimonials') }}</h1>
            <p class="text-muted-foreground mt-1">{{ __('messages.manage_testimonials_subtitle') }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.testimonials.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.add_testimonial') }}
            </a>
        </div>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($testimonials as $testimonial)
        <div class="bg-card border border-border rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    @if($testimonial->image)
                        <img src="{{ Storage::url($testimonial->image) }}"
                             alt="{{ $testimonial->name }}"
                             class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="text-primary font-medium">{{ substr($testimonial->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <h3 class="font-semibold text-foreground">{{ $testimonial->name }}</h3>
                        <p class="text-xs text-muted-foreground">{{ $testimonial->position }}</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.testimonials.show', $testimonial) }}"
                       class="text-muted-foreground hover:text-primary transition-colors">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                       class="text-muted-foreground hover:text-primary transition-colors">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-muted-foreground hover:text-red-500 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="mb-4">
                <div class="flex items-center mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star text-sm {{ $i <= $testimonial->rating ? 'text-yellow-500' : 'text-muted-foreground' }}"></i>
                    @endfor
                    <span class="ml-2 text-sm text-muted-foreground">{{ $testimonial->rating }}/5</span>
                </div>
                <p class="text-muted-foreground text-sm">{{ Str::limit($testimonial->content, 100) }}</p>
            </div>
            <div class="flex items-center justify-between">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $testimonial->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                    {{ $testimonial->is_active ? __('messages.active') : __('messages.inactive') }}
                </span>
                <span class="text-xs text-muted-foreground">{{ __('messages.order') }}: {{ $testimonial->sort_order }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-quote-left text-6xl text-muted-foreground mb-4"></i>
            <h3 class="text-lg font-medium text-foreground mb-2">{{ __('messages.no_testimonials') }}</h3>
            <p class="text-muted-foreground mb-6">{{ __('messages.no_testimonials_description') }}</p>
            <a href="{{ route('admin.testimonials.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.create_first_testimonial') }}
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($testimonials->hasPages())
    <div class="flex justify-center">
        {{ $testimonials->links() }}
    </div>
    @endif
</div>
@endsection
