@extends('layouts.admin')

@section('title', __('messages.legal_pages'))

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ __('messages.legal_pages') }}</h1>
            <p class="text-muted-foreground">{{ __('messages.manage_legal_pages_subtitle') }}</p>
        </div>
        <a href="{{ route('admin.legal-pages.create') }}"
           class="bg-primary text-primary-foreground px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
            <i class="fas fa-plus mr-2"></i>{{ __('messages.add_legal_page') }}
        </a>
    </div>
</div>

@if(session('success'))
<div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg mb-6">
    {{ session('success') }}
</div>
@endif

<div class="bg-card rounded-lg border border-border shadow-sm">
    @if($legalPages->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-muted/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                        {{ __('messages.type') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                        {{ __('messages.title') }}
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
                @foreach($legalPages as $legalPage)
                <tr class="hover:bg-muted/30 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @switch($legalPage->type)
                                @case('privacy')
                                    <i class="fas fa-shield-alt text-primary mr-3"></i>
                                    {{ __('messages.privacy_policy') }}
                                    @break
                                @case('terms')
                                    <i class="fas fa-file-contract text-primary mr-3"></i>
                                    {{ __('messages.terms_of_service') }}
                                    @break
                                @case('cookies')
                                    <i class="fas fa-cookie-bite text-primary mr-3"></i>
                                    {{ __('messages.cookies_policy') }}
                                    @break
                                @default
                                    <i class="fas fa-file-alt text-primary mr-3"></i>
                                    {{ $legalPage->type }}
                            @endswitch
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-card-foreground">
                            {{ json_decode($legalPage->title, true)[app()->getLocale()] ?? json_decode($legalPage->title, true)['en'] ?? 'No title' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $legalPage->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400' }}">
                            {{ $legalPage->is_active ? __('messages.active') : __('messages.inactive') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                        {{ $legalPage->updated_at->format('M j, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('legal.show', $legalPage->type) }}"
                               class="text-primary hover:text-primary/80 transition-colors"
                               target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <a href="{{ route('admin.legal-pages.show', $legalPage) }}"
                               class="text-primary hover:text-primary/80 transition-colors">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.legal-pages.edit', $legalPage) }}"
                               class="text-primary hover:text-primary/80 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.legal-pages.destroy', $legalPage) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
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
        <i class="fas fa-file-alt text-muted-foreground text-4xl mb-4"></i>
        <h3 class="text-lg font-medium text-foreground mb-2">{{ __('messages.no_legal_pages') }}</h3>
        <p class="text-muted-foreground mb-6">{{ __('messages.no_legal_pages_description') }}</p>
        <a href="{{ route('admin.legal-pages.create') }}"
           class="bg-primary text-primary-foreground px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
            {{ __('messages.create_first_legal_page') }}
        </a>
    </div>
    @endif
</div>
@endsection
