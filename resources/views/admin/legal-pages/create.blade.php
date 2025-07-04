@extends('layouts.admin')

@section('title', __('messages.create_legal_page'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('messages.create_legal_page') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ __('messages.add_legal_page_subtitle') }}
                </p>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="{{ route('admin.legal-pages.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('messages.back_to_legal_pages') }}
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <form method="POST" action="{{ route('admin.legal-pages.store') }}" class="divide-y divide-gray-200">
                @csrf

                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Page Type -->
                        <div class="sm:col-span-3">
                            <label for="type" class="block text-sm font-medium text-gray-700">
                                {{ __('messages.page_type') }}
                            </label>
                            <select id="type" name="type" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('type') border-red-500 @enderror">
                                <option value="">{{ __('messages.select_page_type') }}</option>
                                <option value="privacy" {{ old('type') == 'privacy' ? 'selected' : '' }}>{{ __('messages.privacy_policy') }}</option>
                                <option value="terms" {{ old('type') == 'terms' ? 'selected' : '' }}>{{ __('messages.terms_of_use') }}</option>
                                <option value="cookies" {{ old('type') == 'cookies' ? 'selected' : '' }}>{{ __('messages.cookie_policy') }}</option>
                                <option value="legal_notice" {{ old('type') == 'legal_notice' ? 'selected' : '' }}>{{ __('messages.legal_notice') }}</option>
                                <option value="data_protection" {{ old('type') == 'data_protection' ? 'selected' : '' }}>{{ __('messages.data_protection') }}</option>
                                <option value="disclaimer" {{ old('type') == 'disclaimer' ? 'selected' : '' }}>{{ __('messages.disclaimer') }}</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>{{ __('messages.other') }}</option>
                            </select>
                            @error('type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('messages.publication_status') }}
                            </label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">{{ __('messages.published') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Multilingual Content -->
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        {{ __('messages.multilingual_content') }}
                    </h3>

                    <!-- English Content -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium text-gray-700 mb-4 flex items-center">
                            <i class="fas fa-flag mr-2"></i>
                            {{ __('messages.english_content') }}
                        </h4>

                        <div class="grid grid-cols-1 gap-y-6">
                            <!-- English Title -->
                            <div>
                                <label for="title_en" class="block text-sm font-medium text-gray-700">
                                    {{ __('messages.title_en') }}
                                </label>
                                <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}" required
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('title_en') border-red-500 @enderror">
                                @error('title_en')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- English Content -->
                            <div>
                                <label for="content_en" class="block text-sm font-medium text-gray-700">
                                    {{ __('messages.content_en') }}
                                </label>
                                <textarea name="content_en" id="content_en" rows="10" required
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('content_en') border-red-500 @enderror">{{ old('content_en') }}</textarea>
                                @error('content_en')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- French Content -->
                    <div>
                        <h4 class="text-md font-medium text-gray-700 mb-4 flex items-center">
                            <i class="fas fa-flag mr-2"></i>
                            {{ __('messages.french_content') }}
                        </h4>

                        <div class="grid grid-cols-1 gap-y-6">
                            <!-- French Title -->
                            <div>
                                <label for="title_fr" class="block text-sm font-medium text-gray-700">
                                    {{ __('messages.title_fr') }}
                                </label>
                                <input type="text" name="title_fr" id="title_fr" value="{{ old('title_fr') }}" required
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('title_fr') border-red-500 @enderror">
                                @error('title_fr')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- French Content -->
                            <div>
                                <label for="content_fr" class="block text-sm font-medium text-gray-700">
                                    {{ __('messages.content_fr') }}
                                </label>
                                <textarea name="content_fr" id="content_fr" rows="10" required
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('content_fr') border-red-500 @enderror">{{ old('content_fr') }}</textarea>
                                @error('content_fr')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.legal-pages.index') }}"
                           class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('messages.cancel') }}
                        </a>
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('messages.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
