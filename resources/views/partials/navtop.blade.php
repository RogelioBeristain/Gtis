<nav class="navbar  navbar-expand-md navbar-light  bg-white shadow-sm ">
    
    
        <a class="navbar-brand" href="{{ url('/') }}">
           

            <img src="{{asset('/logo_t.png')}}" height="50px" alt=" {{ config('app.name', 'Sistema Gtis') }}">
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @guest
            
            @else
            <ul class="navbar-nav mr-auto">
             @can('role-list')
                <a class="nav-link" href="{{route('rate.index')}}">Cotizaciones</a>
                <a class="nav-link" href="{{route('client.index') }}">Clientes</a>
                <a class="nav-link" href="{{ route('product.index')}}">Productos</a>
                <a class="nav-link" href=" {{  route('kit.index' )}} ">Kits  </a>
                <a class="nav-link" href=" {{  route('manufacturer.index' )}} ">Fabricantes </a>
                <a class="nav-link" href=" {{  route('wholesaler.index' )}} ">Mayoristas </a>
                <a class="nav-link" href=" {{  route('user.index' )}} ">Usuarios </a>
               <a class="nav-link" href=" {{  route('roles.index' )}} ">Roles </a>
          
       
     
           @endcan
           <a class="nav-link" href=" {{  route('client.home' )}} ">Mesa de Ayuda</a>
           
           </ul>
            @endguest

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"> Crear una cuenta</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Cuenta  {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                               @can('role-list')
                            <a  class="dropdown-item" href="{{route('user.profile',Auth::user()->id)}}">Mi Perfil</a>

                @endcan
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                               Salir
                            </a>

                           
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
   
</nav>

