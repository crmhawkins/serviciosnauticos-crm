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
            'active' => request()->is('admin/socios') || request()->is('admin/socios/*'),
            'visible' => true,
        ],
        [
            'href' => url('/admin/favoritos'),
            'label' => 'Favoritos',
            'icon' => 'bi-star-fill',
            'active' => request()->is('admin/favoritos*'),
            'visible' => in_array((int) optional($user)->role, [1, 6], true),
            'badge' => \App\Models\FavoritoSocio::whereNull('viewed_at')->count(),
        ],
        [
            'href' => url('/admin/club'),
            'label' => 'Club',
            'icon' => 'bi-building',
            'active' => request()->is('admin/club*'),
            'visible' => in_array((int) optional($user)->role, [1,6,7,8], true),
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
        [
            'href' => url('/admin/club-create'),
            'label' => 'Crear club',
            'icon' => 'bi-plus-circle',
            'active' => request()->is('admin/club-create'),
            'visible' => in_array((int) optional($user)->role, [1,6,7,8], true),
        ],
    ];
@endphp

<nav class="top-main-nav">
    <div class="top-main-nav__inner">
        <a class="top-main-nav__brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo_empresa.png') }}" alt="Logo" style="height:28px;width:auto;display:inline-block;margin-right:8px;vertical-align:middle">
            <span>MARINERÍA CRM</span>
        </a>
        <ul class="top-main-nav__list">
            @foreach ($items as $item)
                @if($item['visible'])
                <li class="top-main-nav__item {{ $item['active'] ? 'is-active' : '' }}">
                    <a href="{{ $item['href'] }}" class="top-main-nav__link" style="position:relative;">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                        @if(isset($item['badge']) && $item['badge'] > 0)
                            <span class="badge badge-danger favoritos-badge-top" id="favoritos-badge-top" style="position:absolute;top:-5px;right:-8px;min-width:18px;height:18px;padding:2px 6px;font-size:10px;border-radius:9px;animation:pulse 2s infinite;">{{ $item['badge'] }}</span>
                        @endif
                    </a>
                </li>
                @endif
            @endforeach
            <li class="top-main-nav__item" style="margin-left:auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="top-main-nav__link" style="border:none;background:transparent;display:flex;align-items:center;gap:.5rem;cursor:pointer">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Salir</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<style>
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.7;
            transform: scale(1.1);
        }
    }
    .favoritos-badge-top {
        animation: pulse 2s infinite;
    }
</style>

@if(in_array((int) optional($user)->role, [1, 6], true))
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Actualizar badge cada 30 segundos
    function actualizarBadge() {
        fetch('{{ route("favoritos.contador") }}', {
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            const badgeTop = document.getElementById('favoritos-badge-top');
            const badgeSidebar = document.getElementById('favoritos-badge-sidebar');
            
            if (data.count > 0) {
                if (badgeTop) {
                    badgeTop.textContent = data.count;
                    badgeTop.style.display = 'inline-block';
                }
                if (badgeSidebar) {
                    badgeSidebar.textContent = data.count;
                    badgeSidebar.style.display = 'inline-block';
                }
            } else {
                if (badgeTop) badgeTop.style.display = 'none';
                if (badgeSidebar) badgeSidebar.style.display = 'none';
            }
        })
        .catch(error => console.error('Error al actualizar badge:', error));
    }
    
    // Verificar si hay favoritos nuevos al cargar
    fetch('{{ route("favoritos.hay-nuevos") }}', {
        credentials: 'same-origin',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.hayNuevos && !sessionStorage.getItem('favoritos-alerta-mostrada')) {
            alert('¡Tienes nuevos favoritos! Revisa la sección de Favoritos.');
            sessionStorage.setItem('favoritos-alerta-mostrada', 'true');
        }
    });
    
    // Actualizar badge periódicamente
    setInterval(actualizarBadge, 30000);
    actualizarBadge();
});
</script>
@endif

