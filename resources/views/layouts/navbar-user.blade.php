<nav class="navbar navbar-expand-md network-navbar text-white">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ url('home') }}">
            <i class="fab fa-internet-explorer" style="color: white;"></i>
        </a>
        <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fas fa-toggle-on"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <form class="form-inline" action="{{ url('friends/index/search')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}">
                            <div class="input-group-prepend">
                                <button type="submit" class="input-group-text btn btn-default"><i class="fas fa-search"></i></button>
                            </div>                                    
                        </div>
                    </form>                            
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('profile') }}">
                        <img src="{{ url('storage/images') }}/{{ Auth::user()->profile_image }}" style="height: 30px;">
                        {{ Auth::user()->firstname }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('friends/index/list') }}">Find Friends |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('friends/index/requests') }}">
                        <i class="fas fa-users" id="friends-request"></i>
                        <span class="badge badge-warning" id="number-of-requests"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('messages/index') }}"><i class="fas fa-comments"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white " href="#" id="navbardrop" data-toggle="dropdown" onclick="showNotifications()">
                        <i class="fas fa-bell" id="notifications"></i>
                        <span class="badge" id="number-of-notifications"></span>
                    </a>
                    <div class="dropdown-menu" id="show-notifications" style="width: 425px; margin-left: -350px;">
                       <!-- show notifications --> 
                    </div>
                </li>               

                <script src="{{ asset('js/script.js') }}"></script>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ url('profile/edit') }}" class="dropdown-item">Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>

        </div>
    </div>
</nav>


