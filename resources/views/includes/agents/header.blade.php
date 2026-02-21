<aside class="md:block md:w-auto" aria-label="Sidebar">
    <ul>
        <li>
            <a href="{{url('/agent/dashboard')}}" class="py-2">
                <img src="{{ asset('/images/logo_small.png') }}" alt="">
            </a>
        </li>

        <li>
            <a href="{{url('/agent/dashboard')}}"><i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{url('/agent/property/listing')}}"><i class="fas fa-home"></i>
                <div>Properties</div>
            </a>
        </li>

        <li>
            <a href="{{url('/agent/billing')}}"><i class="far fa-credit-card"></i>
                <div>Subscription</div>
            </a>
        </li>

        <li>
            <a href="{{url('/agent/profile')}}"><i class="fas fa-user"></i>
                <div>Profile</div>
            </a>
        </li>

        <li>
            <div class="relative inline-flex">
                <a href="{{url('/agent/notifications')}}"><i class="fas fa-bell"></i>
                    <div>Notifications</div>
                </a>
                @livewire('agent.notification-count')
            </div>
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="route('logout')"
                   onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="fas fa-door-open"></i>
                    {{ __('Sign Out') }}
                </a>
            </form>
        </li>
    </ul>
</aside>