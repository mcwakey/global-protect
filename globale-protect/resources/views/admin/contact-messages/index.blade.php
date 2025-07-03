@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ __('messages.contact_messages') }}</h1>
            <p class="text-muted-foreground mt-1">{{ __('messages.manage_messages_subtitle') }}</p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-2">
            <a href="{{ route('admin.contact-messages.index', ['filter' => 'unread']) }}"
               class="inline-flex items-center px-4 py-2 {{ request('filter') === 'unread' ? 'bg-primary text-primary-foreground' : 'bg-secondary text-secondary-foreground' }} rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-envelope mr-2"></i>
                {{ __('messages.unread') }} ({{ $unreadCount }})
            </a>
            <a href="{{ route('admin.contact-messages.index') }}"
               class="inline-flex items-center px-4 py-2 {{ !request('filter') ? 'bg-primary text-primary-foreground' : 'bg-secondary text-secondary-foreground' }} rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-list mr-2"></i>
                {{ __('messages.all_messages') }}
            </a>
        </div>
    </div>

    <!-- Messages List -->
    <div class="bg-card border border-border rounded-lg overflow-hidden">
        @if($messages->count() > 0)
        <div class="divide-y divide-border">
            @foreach($messages as $message)
            <div class="p-6 hover:bg-secondary/50 transition-colors {{ !$message->is_read ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-primary font-medium">{{ substr($message->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-1">
                                <h3 class="text-lg font-medium text-foreground">{{ $message->name }}</h3>
                                @if(!$message->is_read)
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                @endif
                            </div>
                            <p class="text-sm text-muted-foreground mb-2">{{ $message->email }}</p>
                            @if($message->subject)
                                <p class="text-sm font-medium text-foreground mb-2">{{ __('messages.subject') }}: {{ $message->subject }}</p>
                            @endif
                            <p class="text-foreground">{{ $message->message }}</p>
                            <div class="flex items-center space-x-4 mt-3 text-sm text-muted-foreground">
                                <span>{{ $message->created_at->format('M j, Y H:i') }}</span>
                                <span>{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if(!$message->is_read)
                            <form action="{{ route('admin.contact-messages.mark-read', $message) }}"
                                  method="POST"
                                  class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="text-muted-foreground hover:text-primary transition-colors"
                                        title="{{ __('messages.mark_as_read') }}">
                                    <i class="fas fa-envelope-open"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.contact-messages.mark-unread', $message) }}"
                                  method="POST"
                                  class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="text-muted-foreground hover:text-primary transition-colors"
                                        title="{{ __('messages.mark_as_unread') }}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </form>
                        @endif
                        <a href="mailto:{{ $message->email }}"
                           class="text-muted-foreground hover:text-primary transition-colors"
                           title="{{ __('messages.reply') }}">
                            <i class="fas fa-reply"></i>
                        </a>
                        <form action="{{ route('admin.contact-messages.destroy', $message) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-muted-foreground hover:text-red-500 transition-colors"
                                    title="{{ __('messages.delete') }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-envelope text-6xl text-muted-foreground mb-4"></i>
            <h3 class="text-lg font-medium text-foreground mb-2">
                {{ request('filter') === 'unread' ? __('messages.no_unread_messages') : __('messages.no_messages') }}
            </h3>
            <p class="text-muted-foreground">
                {{ request('filter') === 'unread' ? __('messages.no_unread_messages_description') : __('messages.no_messages_description') }}
            </p>
        </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
    <div class="flex justify-center">
        {{ $messages->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
