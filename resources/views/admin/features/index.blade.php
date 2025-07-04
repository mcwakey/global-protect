@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ __('messages.features') }}</h1>
            <p class="text-muted-foreground mt-1">{{ __('messages.manage_features_subtitle') }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.features.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.add_feature') }}
            </a>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($features as $feature)
        <div class="bg-card border border-border rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <i class="{{ $feature->icon ?: 'fas fa-star' }} text-primary"></i>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.features.show', $feature) }}"
                       class="text-muted-foreground hover:text-primary transition-colors">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.features.edit', $feature) }}"
                       class="text-muted-foreground hover:text-primary transition-colors">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.features.destroy', $feature) }}"
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
            <h3 class="text-lg font-semibold text-foreground mb-2">{{ $feature->title }}</h3>
            <p class="text-muted-foreground text-sm mb-4">{{ Str::limit($feature->description, 100) }}</p>
            <div class="flex items-center justify-between">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $feature->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                    {{ $feature->is_active ? __('messages.active') : __('messages.inactive') }}
                </span>
                <span class="text-xs text-muted-foreground">{{ __('messages.order') }}: {{ $feature->sort_order }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-star text-6xl text-muted-foreground mb-4"></i>
            <h3 class="text-lg font-medium text-foreground mb-2">{{ __('messages.no_features') }}</h3>
            <p class="text-muted-foreground mb-6">{{ __('messages.no_features_description') }}</p>
            <a href="{{ route('admin.features.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.create_first_feature') }}
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($features->hasPages())
    <div class="flex justify-center">
        {{ $features->links() }}
    </div>
    @endif
</div>
@endsection
