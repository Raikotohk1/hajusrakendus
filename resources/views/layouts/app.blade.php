<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
        
            

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chirps.index') }}">Chirps</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                </ul>

               
                
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
