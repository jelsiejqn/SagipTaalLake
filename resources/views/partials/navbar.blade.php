<nav class="navbar-wrapper">
    <div class="navbar">
        <!-- Logo -->
        <img
            src="{{ asset('images/home_logo.png') }}"
            alt="Logo"
            class="logo"
            onclick="window.location='{{ route('home') }}'"
            style="cursor:pointer;" />

        <!-- Right Side -->
        <div class="navbar-right">

            <!-- Home Button -->
            <button class="nav-btn" onclick="window.location='{{ route('home') }}'">
                Home
            </button>

            <!-- Events Button -->
            <button class="nav-btn" onclick="window.location='{{ route('user.events.index') }}'">
                Events
            </button>

            <!-- Profile Icon -->
            <div class="profile-container" id="profile-container">
                <!-- Clear & visible person icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    viewBox="0 0 24 24" fill="none" stroke="#2C6E49" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="profile-icon">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>

                <div class="dropdown" id="dropdown">
                    @auth
                    <div onclick="window.location='{{ route('user.events.my-events') }}'">
                        <p class="dropdown-txt">My Events</p>
                    </div>
                    <div onclick="window.location='{{ route('user.badges.index') }}'">
                        <p class="dropdown-txt">My Badges</p>
                    </div>
                    <div onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <p class="dropdown-txt">Logout</p>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
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

<style>
    .navbar-wrapper {
        width: 100%;
        position: fixed;
        top: 0;
        z-index: 1000;
        /* Glass effect */
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        /* Safari support */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 0px 0px 30px 30px;
    }

    .navbar {
        max-width: 1200px;
        margin: 0 auto;
        padding: 12px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        height: 50px;
        user-select: none;
    }

    .navbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Buttons */
    .nav-btn {
        background: #486848ff;
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 20px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.25s;
    }

    .nav-btn:hover {
        background: #60856cff;
    }

    /* Profile */
    .profile-container {
        position: relative;
        cursor: pointer;
        padding: 4px;
        border-radius: 50%;
        transition: 0.2s;
    }

    .profile-container:hover {
        background: rgba(0, 0, 0, 0.06);
    }

    /* Dropdown */
    .dropdown {
        display: none;
        position: absolute;
        top: 45px;
        right: 0;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 10px;
        padding: 10px 0;
        width: 160px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.2s ease-out;
    }

    .dropdown div {
        padding: 10px 16px;
    }

    .dropdown div:hover {
        /* background: rgba(0, 0, 0, 0.05); */
    }

    .dropdown-txt {
        margin: 0;
        color: #486848ff;
        font-weight: 500;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profile = document.getElementById('profile-container');
        const dropdown = document.getElementById('dropdown');

        profile.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function(e) {
            if (!profile.contains(e.target)) dropdown.style.display = 'none';
        });
    });
</script>