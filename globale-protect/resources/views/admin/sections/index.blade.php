@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ __('messages.sections') }}</h1>
            <p class="text-muted-foreground mt-1">{{ __('messages.manage_sections_subtitle') }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.sections.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.add_section') }}
            </a>
        </div>
    </div>

    <!-- Sections List -->
    <div class="bg-card border border-border rounded-lg overflow-hidden">
        @if($sections->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            {{ __('messages.name') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            {{ __('messages.type') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            {{ __('messages.order') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            {{ __('messages.status') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            {{ __('messages.updated') }}
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            {{ __('messages.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach($sections as $section)
                    <tr class="hover:bg-secondary/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-foreground">{{ $section->name }}</div>
                            <div class="text-sm text-muted-foreground">{{ Str::limit($section->title, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                {{ $section->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                            {{ $section->sort_order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $section->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                {{ $section->is_active ? __('messages.active') : __('messages.inactive') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                            {{ $section->updated_at->format('M j, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.sections.show', $section) }}"
                                   class="text-muted-foreground hover:text-primary transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.sections.edit', $section) }}"
                                   class="text-muted-foreground hover:text-primary transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.sections.destroy', $section) }}"
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
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-layer-group text-6xl text-muted-foreground mb-4"></i>
            <h3 class="text-lg font-medium text-foreground mb-2">{{ __('messages.no_sections') }}</h3>
            <p class="text-muted-foreground mb-6">{{ __('messages.no_sections_description') }}</p>
            <a href="{{ route('admin.sections.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                {{ __('messages.create_first_section') }}
            </a>
        </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($sections->hasPages())
    <div class="flex justify-center">
        {{ $sections->links() }}
    </div>
    @endif
</div>
@endsection
