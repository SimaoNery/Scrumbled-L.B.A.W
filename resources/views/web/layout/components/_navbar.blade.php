<!-- resources/views/web/sections/static/_navbar.blade.php -->
<div id="collapseMenu"
    class='max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
    <button id="toggleClose"
        class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border'>
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
    </button>

    <ul
        class='lg:flex gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
        <li class='mb-6 hidden max-lg:block'>
            <a href="{{ url('/') }}"><img src="{{ asset('svg/logo.svg') }}" alt="logo" class='w-36' /></a>
        </li>
        @php
            $links = [
                ['route' => 'projects', 'label' => 'Projects'],
                ['route' => 'profiles', 'label' => 'Profiles'],
                ['route' => 'about', 'label' => 'About Us'],
                ['route' => 'contact', 'label' => 'Contact Us'],
                ['route' => 'faq', 'label' => 'FAQ'],
            ];
        
            $user = Auth::user();
            if ($user) {
                $unreadNotifications = App\Models\Notification::where('receiver_id', $user->id)->where('is_read', false)->get();
            }
            else $unreadNotifications = null;
        @endphp
            @if ($unreadNotifications !== null && count($unreadNotifications) > 0)
                <script src="{{ asset('js/notification-dot.js') }}" defer></script>
            @endif
        @foreach ($links as $link)
            <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'>
                <a href="{{ route($link['route']) }}"
                    class="{{ request()->routeIs($link['route']) ? 'text-primary font-bold' : 'text-gray-600' }} hover:text-primary transition-colors duration-300">
                    {{ $link['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div class='flex max-lg:ml-auto space-x-4'>
    @if (Auth::check())
        <x-dropdown>
            <x-slot name="trigger">
                <button
                    class="relative w-10 h-10 text-gray-600 rounded-full bg-gray-100 font-semibold focus:outline-none focus:shadow-outline text-sm overflow-hidden">
                    <img src="{{ auth()->user()->profilePic() }}" alt="Profile Photo"
                        class="absolute inset-0 h-full w-full object-cover">
                </button>
                <div id="pfp-dot" class="absolute top-0 right-0 w-3 h-3 bg-blue-500 rounded-full hidden"></div>
            </x-slot>

            <div class="px-4 py-3 flex gap-3 ">
                <div class="block mt-1">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="block">
                    <div class="text-primary font-normal mb-1">{{ Auth::user()->full_name }}</div>
                    <div class="text-sm text-gray-500 font-medium truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <hr class="border-t border-muted">
            <x-dropdown-item to="{{ route('show.profile', Auth::user()->username) }}" class="flex items-center">
                <span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.5 15H7a4 4 0 0 0-4 4v2"/><path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><circle cx="10" cy="7" r="4"/></svg></span> My Profile
            </x-dropdown-item>
            <x-dropdown-item to="{{ route('inbox', Auth::user()->username) }}" class="flex items-center relative">
                <!-- Blue Dot -->
                <div id="notification-dot" class="hidden absolute top-2 right-[14.8rem] w-3 h-3 bg-blue-500 rounded-full -mr-1"></div>  
                <!-- Bell Icon -->
                <div class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.268 21a2 2 0 0 0 3.464 0"/><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/></svg></div> 
                Notifications
            </x-dropdown-item>
            <x-dropdown-item to="{{ route('profile.settings', Auth::user()->username) }}" class="flex items-center">
                <span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg></span> Settings
            </x-dropdown-item>
            <hr class="border-t border-muted">
            <x-dropdown-item to="{{ url('/logout') }}" class="flex items-center">
                <span class="flex-shrink-0 w-5 h-5 mr-2 text-red-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg></span> Logout
            </x-dropdown-item>
        </x-dropdown>
    @else
        <div class="flex flex-wrap space-x-4">
            <x-button variant="secondary" size="md" href="/login">
                <i class="fas fa-sign-in-alt"></i> Login
            </x-button>
            <x-button variant="primary" size="md" href="/register">
                Get Started
            </x-button>

        </div>
    @endif

    <button id="toggleOpen" class='lg:hidden'>
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
    </button>

    <!-- Toast container -->
    <div id="toast-container" class="fixed top-20 right-4 z-50" data-user-id="{{ Auth::id() }}" data-toast-message="{{ session('toast_message', '') }}" data-audio="{{ asset('storage/sounds/receive.mp3') }}"></div>
</div>



@once
    @push('scripts')
        <script src="{{ asset('js/navbar.js') }}" defer></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js" defer></script>
        <script src="{{ asset('js/toast.js') }}" defer></script>
        <script src="{{ asset('js/notification.js') }}" defer></script>
        @php
            $events = [
                'invite_accept_event' => 'Invitation accepted successfully!',
                'invite_decline_event' => 'Invitation declined.',
                'notifications_deleted' => 'Notifications deleted.',
                'edited_profile' => 'Profile edited successfully!',
                'created_project' =>  'Created project!'
            ];
        @endphp

        @foreach($events as $event => $message)
            @if(session($event))
                <script defer>
                    fetch('/trigger-event', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message: '{{ $message }}',
                            event_type: '{{ $event }}' 
                        })
                    });
                </script>
            @endif
        @endforeach
    @endpush
@endonce
