<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header" style="padding: 0px;">
                <img src="{{ url('storage/images') }}/{{ auth()->user()->cover_image }}" class="w-100 profile-cover-image">
                <div class="row justify-content-left">
                    <img src="{{ url('storage/images') }}/{{ auth()->user()->profile_image }}" class="col-md-3 w-100 profile-image">
                    <p class="col-md-4 pl-0 profile-name"><b>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</b></p>
                </div>
                <nav class="navbar navbar-expand-sm navbar-light justify-content-center" style="margin-top: -18px;">
                    <a class="navbar-brand" href="{{ url('profile') }}">Timeline</a>
                    <a class="navbar-brand" href="{{ url('profile/about') }}">About</a>
                    <a class="navbar-brand" href="{{ url('friends/show') }}">Friends</a>
                    <a class="navbar-brand" href="{{ url('gallery') }}">Photos</a>
                    <a class="navbar-brand" href="{{ url('profile/edit') }}">Settings</a>

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            More
                          </a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Link 1</a>
                            <a class="dropdown-item" href="#">Link 2</a>
                            <a class="dropdown-item" href="#">Link 3</a>
                          </div>
                        </li>
                    </ul>
                </nav> 
            </div>
        </div>
    </div>
</div>