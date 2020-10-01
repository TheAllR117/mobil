<div class="sidebar" data="blue">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('MO') }}</a>
            <a href="#" class="simple-text logo-normal">{{ auth()->user()->name }} {{ auth()->user()->app_name }}</a>
        </div>
        <ul class="nav">
            @for($i=0;$i<count($menus);$i++)
                @foreach($menus[$i] as $menu)
                    @if ($menu->desplegable == 0)
                        <li class="nav-item{{ $pageSlug == $menu->name_modulo ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url($menu->ruta) }}">
                                @if($menu->id_role == 1)
                                    <i class="material-icons-outlined">{{ $menu->icono }}</i>
                                @else
                                    <i class="tim-icons {{ $menu->icono }}"></i>
                                @endif
                                
                                <p>{{ __( $menu->name_modulo) }}</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endfor
             <li class="mt-5">
                <a class="mt-5">
                    
                </a>
            </li>
        </ul>
    </div>
</div>
