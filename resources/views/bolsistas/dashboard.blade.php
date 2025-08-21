<div class="mt-3 space-y-1">
    <!-- Authentication -->
    <form method="POST" action={{ route('bolsistas.logout') }}>
        @csrf
        <x-responsive-nav-link :href="route('bolsistas.logout')"
            onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
    </form>
</div>
