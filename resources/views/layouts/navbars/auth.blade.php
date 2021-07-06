<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/gtis-logo.png">
            </div>
        </a>
        <a href="/" class="simple-text logo-normal">
            {{ __('GTIS') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
           
            @can('role-list')
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-favourite-28"></i>
                    <p>{{ __('HOME') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'rate' || $elementActive == 'sale' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="flase" href="#sales">
                    <i class="nc-icon nc-shop"></i>
                    <p>
                        {{ __('Ventas') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="sales">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('rate.index') }}">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-single-copy-04"></i></span>
                                <span class="sidebar-normal">{{ __(' Cotizaciónes') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="#">
                                <span class="sidebar-mini-icon "><i class="nc-icon nc-single-copy-04"></i> </span>
                                <span class="sidebar-normal">{{ __(' Notas de Remisión ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="#">
                                <span class="sidebar-mini-icon "><i class="nc-icon nc-single-copy-04"></i> </span>
                                <span class="sidebar-normal">{{ __(' Ordenes de Envio ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="#">
                                <span class="sidebar-mini-icon "><i class="nc-icon nc-single-copy-04"></i> </span>
                                <span class="sidebar-normal">{{ __(' Facturas ') }}</span>
                            </a>
                        </li>
            
            
            
                    </ul>
                </div>
            </li>
           
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#inventary">
                    <i class="nc-icon nc-money-coins"></i>
                    <p>
                            {{ __('Inventario') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="inventary">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('product.index') }}">
                                <span class="sidebar-mini-icon"> <i class="nc-icon nc-bag-16"></i></span>
                                <span class="sidebar-normal">{{ __(' PRODUCTOS') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('kit.index') }}">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-app"></i></span>
                                <span class="sidebar-normal">{{ __(' KITS') }}</span>
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </li>

            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#relas">
                    <i class="nc-icon nc-briefcase-24"></i>
                    <p>
                        {{ __('Relaciones') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="relas">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('manufacturer.index') }}">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-box-2"></i></span>
                                <span class="sidebar-normal">{{ __(' Fabricantes') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('wholesaler.index') }}">
                                <span class="sidebar-mini-icon "><i class="nc-icon nc-delivery-fast"></i> </span>
                                <span class="sidebar-normal">{{ __(' Proveedores') }}</span>
                            </a>
                        </li>

                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('client.index') }}">
                                <span class="sidebar-mini-icon "><i class="nc-icon nc-satisfied"></i> </span>
                                <span class="sidebar-normal">{{ __(' Clientes') }}</span>
                            </a>
                        </li>
            
                    </ul>
                </div>
            </li>


            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#control">
                    <i class="nc-icon nc-settings"></i>
                    <p>
                        {{ __('Administrar') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="control">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-single-02"></i></span>
                                <span class="sidebar-normal">{{ __(' Usuarios') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}">
                                <span class="sidebar-mini-icon "><i class="nc-icon nc-tap-01"></i> </span>
                                <span class="sidebar-normal">{{ __(' Roles y Permisos') }}</span>
                            </a>
                        </li>
            
                      
            
                    </ul>
                </div>
            </li>

            @endcan

          
            @can('role-list')
                <li class="{{ $elementActive == 'client' ? 'active' : '' }}">
                    <a href="{{ route('client.mesa') }}">
                        <i class="nc-icon nc-email-85"></i>
                        <p>{{ __('SOLICITUDES') }}</p>
                    </a>
                </li>
            @else

            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('client.home') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Mesa de Ayuda') }}</p>
                </a>
            </li>
                <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('client.mesa') }}">
                        <i class="nc-icon nc-email-85"></i>
                        <p>{{ __('RESPUESTAS') }}</p>
                    </a>
                </li>
                
            @endcan
           
           {{--  <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('ICONOS') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'map') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('MAPAS') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('NOTIFICACIONES') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('TABLAS') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('TIPOGRAFIA') }}</p>
                </a>
            </li> --}}
          {{--   <li class="active-pro {{ $elementActive == 'upgrade' ? 'active' : '' }} bg-danger">
                <a href="{{ route('page.index', 'upgrade') }}">
                    <i class="nc-icon nc-spaceship text-white"></i>
                    <p class="text-white">{{ __('Upgrade to PRO') }}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>