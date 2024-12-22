<!-- resources/views/web/sections/static/_navbar.blade.php -->

<div id="collapseMenu"
    class='max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
    <button id="toggleClose"
        class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border'>
        <x-lucide-x class="w-8 h-8" />
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
        @endphp
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
            </x-slot>

            <div class="px-4 py-3 flex gap-3 ">
                <div class="block mt-1">
                    <x-lucide-user class="w-5 h-5" />
                </div>
                <div class="block">
                    <div class="text-primary font-normal mb-1">{{ Auth::user()->full_name }}</div>
                    <div class="text-sm text-gray-500 font-medium truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <hr class="border-t border-muted">
            <x-dropdown-item to="{{ route('show.profile', Auth::user()->username) }}" class="flex items-center">
                <span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500"><x-lucide-user-pen /></span> My Profile
            </x-dropdown-item>
            <x-dropdown-item to="{{ route('inbox', Auth::user()->username) }}" class="flex items-center">
                <span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500"><x-lucide-bell /></span> Notifications
            </x-dropdown-item>
            <x-dropdown-item to="{{ route('profile.settings', Auth::user()->username) }}" class="flex items-center">
                <span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500"><x-lucide-settings /></span> Settings
            </x-dropdown-item>
            <hr class="border-t border-muted">
            <x-dropdown-item to="{{ url('/logout') }}" class="flex items-center">
                <span class="flex-shrink-0 w-5 h-5 mr-2 text-red-500"><x-lucide-log-out /></span> Logout
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
        <x-lucide-menu class="w-8 h-8" />
    </button>
</div>

@once
    @push('scripts')
        <script src="{{ asset('js/navbar.js') }}"></script>
    @endpush
@endonce
