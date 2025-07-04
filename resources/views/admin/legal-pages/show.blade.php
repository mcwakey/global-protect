@extends('layouts.admin')

@section('title', __('messages.legal_page_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('messages.legal_page_details') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ ucfirst($legalPage->type) }} - {{ $legalPage->is_active ? __('messages.published') : __('messages.draft') }}
                </p>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0 space-x-3">
                <a href="{{ route('admin.legal-pages.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('messages.back_to_legal_pages') }}
                </a>
                <a href="{{ route('admin.legal-pages.edit', $legalPage) }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-edit mr-2"></i>
                    {{ __('messages.edit') }}
                </a>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('messages.basic_information') }}
                </h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{ __('messages.page_type') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($legalPage->type) }}
                            </span>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{ __('messages.status') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($legalPage->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ __('messages.published') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ __('messages.draft') }}
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{ __('messages.created_at') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $legalPage->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{ __('messages.updated_at') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $legalPage->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Multilingual Content Preview -->
        <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('messages.multilingual_content') }}
                </h3>
            </div>

            <!-- English Content -->
            <div class="border-t border-gray-200">
                <div class="bg-blue-50 px-4 py-3 sm:px-6">
                    <h4 class="text-md font-medium text-blue-900 flex items-center">
                        <i class="fas fa-flag mr-2"></i>
                        {{ __('messages.english_content') }}
                    </h4>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    <div class="mb-4">
                        <h5 class="text-sm font-medium text-gray-500 mb-2">{{ __('messages.title') }}</h5>
                        <p class="text-lg font-semibold text-gray-900">{{ json_decode($legalPage->getRawOriginal('title'), true)['en'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h5 class="text-sm font-medium text-gray-500 mb-2">{{ __('messages.content') }}</h5>
                        <div class="prose max-w-none">
                            <div class="text-gray-900 whitespace-pre-wrap">{{ json_decode($legalPage->getRawOriginal('content'), true)['en'] ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- French Content -->
            <div class="border-t border-gray-200">
                <div class="bg-blue-50 px-4 py-3 sm:px-6">
                    <h4 class="text-md font-medium text-blue-900 flex items-center">
                        <i class="fas fa-flag mr-2"></i>
                        {{ __('messages.french_content') }}
                    </h4>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    <div class="mb-4">
                        <h5 class="text-sm font-medium text-gray-500 mb-2">{{ __('messages.title') }}</h5>
                        <p class="text-lg font-semibold text-gray-900">{{ json_decode($legalPage->getRawOriginal('title'), true)['fr'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h5 class="text-sm font-medium text-gray-500 mb-2">{{ __('messages.content') }}</h5>
                        <div class="prose max-w-none">
                            <div class="text-gray-900 whitespace-pre-wrap">{{ json_decode($legalPage->getRawOriginal('content'), true)['fr'] ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Public Preview Link -->
        @if($legalPage->is_active)
        <div class="mt-8 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-external-link-alt text-green-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">
                        Public Page Available
                    </h3>
                    <div class="mt-2 text-sm text-green-700">
                        <p>This legal page is currently published and accessible at:</p>
                        <a href="{{ route('legal.show', $legalPage->type) }}" target="_blank"
                           class="font-medium underline hover:text-green-600">
                            {{ route('legal.show', $legalPage->type) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
