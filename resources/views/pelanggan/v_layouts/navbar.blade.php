<header class="navbar">
    <h3>Listik Pay</h3>
    <nav class="menu">
        <!-- Menu Beranda -->
        <a href="{{ route('pelanggan.dashboard') }}" class="menu-item {{ request()->routeIs('pelanggan.dashboard') ? 'is-active' : '' }}">
            Beranda
        </a>
        @auth
            <!-- Menu Profil Saya -->
            <a href="{{ route('pelanggan.profil') }}" class="menu-item {{ request()->routeIs('pelanggan.profil') ? 'is-active' : '' }}">
                Profil Saya
            </a>
            <!-- Menu Info Tagihan -->
            <a href="{{ route('pelanggan.tagihan') }}" class="menu-item {{ request()->routeIs('pelanggan.tagihan') ? 'is-active' : '' }}">
                Info Tagihan
            </a>
            <!-- Logout -->
            <a href="{{ route('logout') }}" class="menu-item"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Log out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <!-- Login -->
            <a href="{{ route('login') }}" class="menu-item {{ request()->routeIs('login') ? 'is-active' : '' }}">
                Log in
            </a>
        @endauth
    </nav>
</header>
