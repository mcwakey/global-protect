@extends('layouts.admin')

@section('title', __('messages.settings'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('messages.settings') }}</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ __('messages.manage_settings_subtitle') }}</p>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium">{{ __('messages.whoops_something_went_wrong') }}</h3>
                    <div class="mt-2 text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Settings Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PATCH')

        <!-- Site Settings Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('messages.site_settings') }}</h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- Site Name -->
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.site_name') }}
                    </label>
                    <input type="text"
                           id="site_name"
                           name="site_name"
                           value="{{ old('site_name', $settings->get('site_name')->value ?? config('app.name')) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                           required>
                </div>

                <!-- Site Description -->
                <div>
                    <label for="site_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.site_description') }}
                    </label>
                    <textarea id="site_description"
                              name="site_description"
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('site_description', $settings->get('site_description')->value ?? '') }}</textarea>
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Contact Email -->
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('messages.contact_email') }}
                        </label>
                        <input type="email"
                               id="contact_email"
                               name="contact_email"
                               value="{{ old('contact_email', $settings->get('contact_email')->value ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('messages.contact_phone') }}
                        </label>
                        <input type="text"
                               id="contact_phone"
                               name="contact_phone"
                               value="{{ old('contact_phone', $settings->get('contact_phone')->value ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <!-- Contact Address -->
                <div>
                    <label for="contact_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.contact_address') }}
                    </label>
                    <textarea id="contact_address"
                              name="contact_address"
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('contact_address', $settings->get('contact_address')->value ?? '') }}</textarea>
                </div>

                <!-- Emergency Number -->
                <div>
                    <label for="emergency_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.emergency_number') }}
                    </label>
                    <input type="text"
                           id="emergency_number"
                           name="emergency_number"
                           value="{{ old('emergency_number', $settings->get('emergency_number')->value ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
            </div>
        </div>

        <!-- Logo & Branding Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('messages.logo') }} & Branding</h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- Logo Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.logo') }}
                    </label>

                    @if($settings->get('logo') && $settings->get('logo')->value)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('messages.current_logo') }}:</p>
                            <div class="flex items-center space-x-4">
                                <img src="{{ \App\Models\Setting::get('logo') }}"
                                     alt="Current Logo"
                                     class="h-12 w-auto bg-gray-100 dark:bg-gray-700 rounded p-2">
                                <button type="button"
                                        onclick="deleteLogo()"
                                        class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900/20 dark:text-red-300 dark:border-red-700 dark:hover:bg-red-900/30">
                                    <i class="fas fa-trash mr-1"></i>
                                    {{ __('messages.delete_logo') }}
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="relative">
                        <input type="file"
                               id="logo"
                               name="logo"
                               accept="image/*"
                               class="hidden"
                               onchange="updateFileName('logo', 'logo-filename')">
                        <label for="logo"
                               class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                            <i class="fas fa-upload mr-2"></i>
                            {{ __('messages.choose_file') }}
                        </label>
                        <span id="logo-filename" class="ml-3 text-sm text-gray-500 dark:text-gray-400">{{ __('messages.no_file_chosen') }}</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        PNG, JPG, GIF up to 2MB
                    </p>
                </div>

                <!-- Favicon Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.favicon') }}
                    </label>

                    @if($settings->get('favicon') && $settings->get('favicon')->value)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('messages.current_favicon') }}:</p>
                            <div class="flex items-center space-x-4">
                                <img src="{{ \App\Models\Setting::get('favicon') }}"
                                     alt="Current Favicon"
                                     class="h-8 w-8 bg-gray-100 dark:bg-gray-700 rounded">
                                <button type="button"
                                        onclick="deleteFavicon()"
                                        class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900/20 dark:text-red-300 dark:border-red-700 dark:hover:bg-red-900/30">
                                    <i class="fas fa-trash mr-1"></i>
                                    {{ __('messages.delete_favicon') }}
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="relative">
                        <input type="file"
                               id="favicon"
                               name="favicon"
                               accept="image/*"
                               class="hidden"
                               onchange="updateFileName('favicon', 'favicon-filename')">
                        <label for="favicon"
                               class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                            <i class="fas fa-upload mr-2"></i>
                            {{ __('messages.choose_file') }}
                        </label>
                        <span id="favicon-filename" class="ml-3 text-sm text-gray-500 dark:text-gray-400">{{ __('messages.no_file_chosen') }}</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        ICO, PNG up to 1MB
                    </p>
                </div>
            </div>
        </div>

        <!-- Color Customization Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('messages.color_customization') }}</h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- Color Preview -->
                <div id="color-preview" class="p-4 rounded-lg border border-gray-200 dark:border-gray-600 bg-gradient-to-r from-blue-600 to-blue-800">
                    <div class="flex items-center space-x-3 text-white">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span class="font-semibold">{{ __('messages.color_preview') }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Primary Color -->
                    <div>
                        <label for="primary_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('messages.primary_color') }}
                        </label>
                        <div class="flex items-center space-x-3">
                            <input type="color"
                                   id="primary_color"
                                   name="primary_color"
                                   value="{{ old('primary_color', $settings->get('primary_color')->value ?? '#2563eb') }}"
                                   class="w-12 h-10 border border-gray-300 dark:border-gray-600 rounded cursor-pointer"
                                   onchange="updateColorPreview()">
                            <input type="text"
                                   id="primary_color_text"
                                   value="{{ old('primary_color', $settings->get('primary_color')->value ?? '#2563eb') }}"
                                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                   onchange="syncColorInputs('primary')">
                        </div>
                    </div>

                    <!-- Secondary Color -->
                    <div>
                        <label for="secondary_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('messages.secondary_color') }}
                        </label>
                        <div class="flex items-center space-x-3">
                            <input type="color"
                                   id="secondary_color"
                                   name="secondary_color"
                                   value="{{ old('secondary_color', $settings->get('secondary_color')->value ?? '#1e40af') }}"
                                   class="w-12 h-10 border border-gray-300 dark:border-gray-600 rounded cursor-pointer"
                                   onchange="updateColorPreview()">
                            <input type="text"
                                   id="secondary_color_text"
                                   value="{{ old('secondary_color', $settings->get('secondary_color')->value ?? '#1e40af') }}"
                                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                   onchange="syncColorInputs('secondary')">
                        </div>
                    </div>

                    <!-- Accent Color -->
                    <div>
                        <label for="accent_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('messages.accent_color') }}
                        </label>
                        <div class="flex items-center space-x-3">
                            <input type="color"
                                   id="accent_color"
                                   name="accent_color"
                                   value="{{ old('accent_color', $settings->get('accent_color')->value ?? '#3b82f6') }}"
                                   class="w-12 h-10 border border-gray-300 dark:border-gray-600 rounded cursor-pointer"
                                   onchange="updateColorPreview()">
                            <input type="text"
                                   id="accent_color_text"
                                   value="{{ old('accent_color', $settings->get('accent_color')->value ?? '#3b82f6') }}"
                                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                   onchange="syncColorInputs('accent')">
                        </div>
                    </div>
                </div>

                <!-- Reset Button -->
                <div class="flex justify-start">
                    <button type="button"
                            onclick="resetColorsToDefault()"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-undo mr-2"></i>
                        {{ __('messages.reset_to_default') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- System Settings Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">System Settings</h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- Maintenance Mode -->
                <div class="flex items-center justify-between">
                    <div>
                        <label for="maintenance_mode" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('messages.maintenance_mode') }}
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Put the site in maintenance mode</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox"
                               id="maintenance_mode"
                               name="maintenance_mode"
                               value="1"
                               {{ old('maintenance_mode', $settings->get('maintenance_mode') && $settings->get('maintenance_mode')->value ? 'checked' : '') }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <!-- Enable Registrations -->
                <div class="flex items-center justify-between">
                    <div>
                        <label for="enable_registrations" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('messages.enable_registrations') }}
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Allow new user registrations</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox"
                               id="enable_registrations"
                               name="enable_registrations"
                               value="1"
                               {{ old('enable_registrations', $settings->get('enable_registrations') && $settings->get('enable_registrations')->value ? 'checked' : '') }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3">
            <button type="button"
                    onclick="window.location.href='{{ route('admin.dashboard') }}'"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('messages.cancel') }}
            </button>
            <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                <i class="fas fa-save mr-2"></i>
                {{ __('messages.save_settings') }}
            </button>
        </div>
    </form>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/20 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            Confirm Delete
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400" id="modal-message">
                                Are you sure you want to delete this item?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button"
                        id="confirmDelete"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Delete
                </button>
                <button type="button"
                        onclick="closeModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// File name update function
function updateFileName(inputId, spanId) {
    const input = document.getElementById(inputId);
    const span = document.getElementById(spanId);
    if (input.files.length > 0) {
        span.textContent = input.files[0].name;
    } else {
        span.textContent = '{{ __('messages.no_file_chosen') }}';
    }
}

// Delete functions
let deleteForm = null;

function deleteLogo() {
    showModal('{{ __('messages.confirm_delete_logo') }}', () => {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.settings.delete-logo') }}';
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    });
}

function deleteFavicon() {
    showModal('{{ __('messages.confirm_delete_favicon') }}', () => {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.settings.delete-favicon') }}';
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    });
}

function showModal(message, callback) {
    document.getElementById('modal-message').textContent = message;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('confirmDelete').onclick = () => {
        closeModal();
        callback();
    };
}

function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Color management functions
function updateColorPreview() {
    const primary = document.getElementById('primary_color').value;
    const secondary = document.getElementById('secondary_color').value;
    const preview = document.getElementById('color-preview');

    preview.style.background = `linear-gradient(to right, ${primary}, ${secondary})`;

    // Update text inputs
    document.getElementById('primary_color_text').value = primary;
    document.getElementById('secondary_color_text').value = secondary;
    document.getElementById('accent_color_text').value = document.getElementById('accent_color').value;
}

function syncColorInputs(type) {
    const textInput = document.getElementById(type + '_color_text');
    const colorInput = document.getElementById(type + '_color');

    if (isValidHexColor(textInput.value)) {
        colorInput.value = textInput.value;
        updateColorPreview();
    }
}

function isValidHexColor(hex) {
    return /^#[0-9A-F]{6}$/i.test(hex);
}

function resetColorsToDefault() {
    document.getElementById('primary_color').value = '#2563eb';
    document.getElementById('secondary_color').value = '#1e40af';
    document.getElementById('accent_color').value = '#3b82f6';
    updateColorPreview();
}

// Initialize color preview on page load
document.addEventListener('DOMContentLoaded', function() {
    updateColorPreview();
});
</script>
@endsection
