@php
    $user = Auth::user();
    $items = [
        [
            'href' => route('home'),
            'label' => 'Cambiar de club',
            'icon' => 'bi-arrow-repeat',
            'active' => request()->routeIs('home'),
            'visible' => true,
        ],
        [
            'href' => url('/admin/socios'),
            'label' => 'Socios',
            'icon' => 'bi-people-fill',
            'active' => request()->is('admin/socios*'),
            'visible' => true,
        ],
        [
            'href' => url('/admin/club'),
            'label' => 'Club',
            'icon' => 'bi-building',
            'active' => request()->is('admin/club*'),
            'visible' => optional($user)->role == 1,
        ],
        [
            'href' => url('/admin/usuarios'),
            'label' => 'Usuarios',
            'icon' => 'bi-person-circle',
            'active' => request()->is('admin/usuarios*'),
            'visible' => optional($user)->role == 1,
        ],
        [
            'href' => url('/admin/socios-todos'),
            'label' => 'Todos los Socios',
            'icon' => 'bi-people',
            'active' => request()->is('admin/socios-todos'),
            'visible' => optional($user)->role == 1,
        ],
    ];
@endphp

<nav class="top-main-nav">
    <div class="top-main-nav__inner">
        <a class="top-main-nav__brand" href="{{ route('home') }}">
            <i class="bi bi-compass"></i>
            <span>MARINERÍA CRM</span>
        </a>
        <ul class="top-main-nav__list">
            @foreach ($items as $item)
                @if($item['visible'])
                <li class="top-main-nav__item {{ $item['active'] ? 'is-active' : '' }}">
                    <a href="{{ $item['href'] }}" class="top-main-nav__link">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>

