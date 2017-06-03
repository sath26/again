<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Sichya.com') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}">Question</a></li>
                        <li><a href="{{ url('') }}">Book</a></li>
                        <li><a href="{{ url('') }}">Blog</a></li>
                        <li><a href="{{ url('') }}">Notes</a></li>
                        <li><a href="{{ url('') }}">Tags</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-globe"></span>Notifications 
                                <span class="badge">{{count(auth()->user()->unreadNotifications)}}</span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                       @foreach (auth()->user()->unreadNotifications as $notification)
                                           {{-- <a href="#">{{$notification->type}}</a> --}}
                                           {{-- @include('partials.'.snake_case(class_basename($notification->type))) --}}
                                  {{var_dump($notification)}}
                                       @endforeach 
                                    </li>
                                </ul>
                            </li>
                                 <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li><a href="">My Profile</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
@if (Auth::check())     
            <div class="col-md-4">

                <a href="{{ route('posts.create') }}" class="form-control btn btn-primary">Create a new discussion</a>
                <br>
                <br>
            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tags
                    </div>

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($tags as $tag)
                                <li class="list-group-item">
                                    <a href="{{ route('tag', ['slug' => $tag->slug ]) }}" style="text-decoration: none;">{{ $tag->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
           @endif
            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
     @yield('scripts')
</body>
</html>
