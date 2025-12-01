<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle profileImg" src="{{ asset('graphics/default_profile.png') }}" >
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">{{ Auth::user()->name }}</strong>
                                </span>
                                <span class="text-muted text-xs block">{{ Auth::user()->user_type->description }}<b class="caret"></b></span>
                            </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href={{ url('/profile') }}>Perfil</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    GPMA
                </div>
            </li>
            @foreach($modules as $categ)
                <li class="{{ $categ['classGrp'] }}">
                    <a><i class="{{ $categ['icon'] }}"></i
                        ><span class="nav-label">{{ $categ['name'] }}</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse {{ $categ['classUl'] }}">
                        @foreach($categ['modules'] as $modulo)
                            <li class="{{ $modulo['class'] }}">
                                <a href="{{ route($modulo['url']) }}">
                                    <i class="{{ $modulo['icon'] }}"></i>
                                    <span class="nav-label">{{ $modulo['name'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</nav>