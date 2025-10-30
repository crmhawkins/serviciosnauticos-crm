@php
    // Enlaces más usados: Dashboard/Home, Socios, Facturas, Agenda, Ajustes
    $items = [
        [
            'route' => route('home'),
            'label' => 'Inicio',
            'icon' => 'bi-house-door-fill',
            'active' => request()->routeIs('home'),
        ],
        [
            'route' => route('socios.index'),
            'label' => 'Socios',
            'icon' => 'bi-people-fill',
            'active' => request()->routeIs('socios.index') || request()->routeIs('socios.edit') || request()->routeIs('socios.create') || request()->routeIs('socios.alta'),
        ],
        [
            'route' => route('club.index'),
            'label' => 'Club',
            'icon' => 'bi-building',
            'active' => request()->routeIs('club.*'),
        ],
        [
            'route' => route('usuarios.index'),
            'label' => 'Usuarios',
            'icon' => 'bi-person-badge-fill',
            'active' => request()->routeIs('usuarios.*'),
        ],
        [
            'route' => route('socios.indexadmin'),
            'label' => 'Todos los socios',
            'icon' => 'bi-people',
            'active' => request()->routeIs('socios.indexadmin'),
        ],
    ];
@endphp

<nav class="bottom-nav d-md-none d-lg-none">
    <ul class="bottom-nav__list">
        @foreach ($items as $item)
            <li class="bottom-nav__item {{ $item['active'] ? 'is-active' : '' }}">
                <a href="{{ $item['route'] }}" class="bottom-nav__link" aria-label="{{ $item['label'] }}">
                    <i class="bi {{ $item['icon'] }}"></i>
                    <span class="bottom-nav__label">{{ $item['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
    {{-- Zona segura para dispositivos con notch / gestos --}}
    <div class="bottom-nav__spacer"></div>
</nav>


