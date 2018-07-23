<header id="header">
    <nav id="navigation">
        <div class="main navigation">
            <a href="{{ route('dashboard.home') }}" @navIsSelected('dashboard.home')>
                <i class="home icon"></i>
                <span>Home</span>
            </a>
        </div>

        <div class="visitor navigation">
            <a href="{{ route('dashboard.account') }}" @navIsSelected('dashboard.account')>
                <i class="user icon"></i>
                <span>Account</span>
            </a>

            <a href="{{ route('logout', ['_token' => csrf_token()]) }}">
                <i class="logout icon"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>
</header>