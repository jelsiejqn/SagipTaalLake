<nav class="navbar-wrapper">
    <div class="navbar">
        <!-- Logo -->
        <img
            src="{{ asset('images/home_logo.png') }}"
            alt="Logo"
            class="logo"
            onclick="window.location='{{ route('home') }}'"
            style="cursor: pointer;"
        />

        <!-- Right Side -->
        <div class="navbar-right">
            <button class="adopt-btn" onclick="window.location='{{ route('user.events.index') }}'">
                Events
            </button>

            <!-- Profile Icon -->
            <div class="profile-container" id="profile-container">
                <svg class="profile-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="32" height="32">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                </svg>

                <div class="dropdown" id="dropdown">
                    @auth
                        <div onclick="window.location='{{ route('user.account') }}'">
                            <p class="dropdown-txt">Account Settings</p>
                        </div>
                        <div onclick="window.location='{{ route('user.events.my-events') }}'">
                            <p class="dropdown-txt">My Events</p>
                        </div>
                        <div onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <p class="dropdown-txt">Logout</p>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <div onclick="window.location='{{ route('register') }}'">
                            <p class="dropdown-txt">Sign Up</p>
                        </div>
                        <div onclick="window.location='{{ route('login') }}'">
                            <p class="dropdown-txt">Login</p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileContainer = document.getElementById('profile-container');
    const dropdown = document.getElementById('dropdown');
    
    profileContainer.addEventListener('mouseenter', function() {
        dropdown.style.display = 'block';
    });
    
    profileContainer.addEventListener('mouseleave', function() {
        dropdown.style.display = 'none';
    });
});
</script>
