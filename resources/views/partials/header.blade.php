<div class="row border-bottom">
    <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-header" href="#" id="hideShowSideBar"><i class="fa fa-bars"></i></a>

        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Bienvenido</span>
            </li>

            <li>
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" title="Salir">
                    <i class="fa fa-sign-out text-white"></i> Salir
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
            </li>
        </ul>

    </nav>
</div>