<div>
    <style>
        ul.pagination { justify-content: space-evenly; }

        /* Visibilidad por dispositivo */
        #mobile-cards { display: none; }
        #datatable-wrapper { display: block; }

        /* Estilos mobile: cards en lugar de tabla */
        @media (max-width: 768px) {
            #mobile-cards { display: block !important; }
            #datatable-wrapper { display: none !important; }
        }
    </style>
    <!-- Design system y estilos de cards iguales a la vista de Socios -->
    <style>
    :root {
        --primary-blue: #2563eb;
        --primary-blue-dark: #1d4ed8;
        --success-green: #22c55e;
        --success-green-dark: #16a34a;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-700: #374151;
        --gray-900: #111827;
        --space-1: .25rem; --space-2: .5rem; --space-3: .75rem; --space-4: 1rem; --space-6: 1.5rem;
        --border-radius: .5rem; --border-radius-lg: .75rem; --border-radius-xl: 1rem;
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -1px rgba(0,0,0,.06);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -2px rgba(0,0,0,.05);
        --transition-normal: 200ms ease-in-out;
        --font-size-sm: .875rem; --font-size-base: 1rem; --font-size-lg: 1.125rem;
    }

    @media (max-width: 768px) {
        .cards-container { display: flex; flex-direction: column; gap: var(--space-4); }
        .socio-card { background: #fff; border-radius: var(--border-radius-xl); box-shadow: var(--shadow-md); border: 1px solid var(--gray-200); overflow: hidden; transition: all var(--transition-normal); }
        .socio-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-2px); }
        .card-header { padding: var(--space-4); border-bottom: 1px solid var(--gray-200); display:flex; justify-content: space-between; align-items:flex-start; }
        .socio-info { display:flex; gap: var(--space-3); flex:1; }
        .socio-photo-section { flex-shrink:0; }
        .photo-wrapper { position:relative; width:60px; height:60px; }
        .socio-photo { width:100%; height:100%; object-fit:cover; border-radius: var(--border-radius); border:2px solid var(--gray-200); }
        .photo-placeholder { width:100%; height:100%; background: var(--gray-100); border:2px solid var(--gray-200); border-radius: var(--border-radius); display:flex; align-items:center; justify-content:center; color:#9ca3af; }
        .socio-details { flex:1; min-width:0; }
        .socio-name { font-size: var(--font-size-lg); font-weight:600; color: var(--gray-900); margin:0 0 var(--space-1) 0; }
        .barco-name { font-size: var(--font-size-base); color:#6b7280; margin:0 0 var(--space-2) 0; }
        .socio-meta { display:flex; flex-direction:column; gap: var(--space-1); }
        .pantalan-info, .matricula-info { display:flex; align-items:center; gap: var(--space-1); font-size: var(--font-size-sm); color: var(--gray-500); }
        .pantalan-info i, .matricula-info i { color: var(--primary-blue); width:12px; }
        .card-content { padding: var(--space-4); }
        .telefonos-section { margin-bottom: var(--space-4); }
        .section-title { font-size: var(--font-size-sm); font-weight: 600; color: var(--gray-700); margin: 0 0 var(--space-3) 0; display:flex; align-items:center; gap: var(--space-2); }
        .section-title i { color: var(--primary-blue); }
        .telefonos-list { display:flex; flex-direction:column; gap: var(--space-2); }
        .telefono-item { display:flex; justify-content:space-between; align-items:center; padding: var(--space-2) var(--space-3); background: var(--gray-50); border-radius: var(--border-radius); }
        .telefono-number { font-weight:500; color: var(--gray-900); }
        .telefono-actions { display:flex; gap: var(--space-1); }
        .btn-telefono { display:flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius: var(--border-radius); text-decoration:none; transition: all var(--transition-normal); }
        .btn-telefono.btn-call { background: #4b5563; color:#fff; }
        .btn-telefono.btn-call:hover { background: #374151; color:#fff; }
        .btn-telefono.btn-whatsapp { background: #25d366; color:#fff; }
        .btn-telefono.btn-whatsapp:hover { background: #128c7e; color:#fff; }
        .card-actions { padding: var(--space-4); border-top:1px solid var(--gray-200); background: var(--gray-50); }
        .btn-card { display:flex; align-items:center; justify-content:center; gap: var(--space-2); width:100%; padding: var(--space-3) var(--space-4); border-radius: var(--border-radius-lg); font-weight:600; text-decoration:none; transition: all var(--transition-normal); }
        .btn-edit { background: var(--primary-blue) !important; color:#fff !important; border:none; }
        .btn-edit:hover { background: var(--primary-blue-dark) !important; color:#fff !important; }
        .btn-alta { background: var(--success-green) !important; color:#fff !important; border:none; }
        .btn-alta:hover { background: var(--success-green-dark) !important; color:#fff !important; }
        .socio-card.is-hidden { display: none !important; }
    }
    </style>
    @if (count($socios) > 0)
        @mobile
        <div class="col-md-12 p-0">
        @elsemobile
        <div class="col-md-12">
        @endmobile
            <div class="p-0">
                <style>
                    #mobile-search { display: none; }
                    @media (max-width: 768px) {
                        #mobile-search { display: block; margin: 0 0 12px 0; }
                        #mobile-search-input { width: 100%; padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 10px; }
                    }
                </style>
                <div id="mobile-search">
                    <div style="display:flex; gap:8px; align-items:center;">
                        <input id="mobile-search-input" type="search" placeholder="Buscar en socios..." style="flex:1;">
                    </div>
                </div>
                <div class="col-12 p-0" id="mobile-cards">
                    @foreach ($socios as $socio)
                        <div class="socio-card" data-search="{{ Str::slug($socio->nombre_barco . ' ' . $socio->nombre_socio . ' ' . $socio->matricula . ' ' . $socio->pantalan_t_atraque, ' ') }}">
                            <div class="card-header">
                                <div class="socio-info">
                                    <div class="socio-photo-section">
                                        <div class="photo-wrapper">
                                            @if($socio->ruta_foto)
                                                <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}" alt="foto" class="socio-photo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="photo-placeholder" style="display:none;"><i class="fas fa-user"></i></div>
                                            @else
                                                <div class="photo-placeholder"><i class="fas fa-user"></i></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="socio-details">
                                        <h3 class="socio-name">{{ $socio->nombre_socio }}</h3>
                                        <p class="barco-name">{{ $socio->nombre_barco }}</p>
                                        <div class="socio-meta">
                                            <span class="pantalan-info"><i class="fas fa-anchor"></i>{{ $socio->pantalan_t_atraque }}</span>
                                            <span class="matricula-info"><i class="fas fa-certificate"></i>{{ $socio->matricula }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="situacion-badge situacion-{{ $socio->situacion_persona }}">
                                    @if ($socio->situacion_persona == 0)
                                        Socio
                                    @elseif ($socio->situacion_persona == 1)
                                        Transeúnte
                                    @else
                                        Socio/Transeúnte
                                    @endif
                                </div>
                            </div>
                            <div class="card-content">
                                @if($socio->telefonos->isNotEmpty())
                                    <div class="telefonos-section">
                                        <h4 class="section-title"><i class="fas fa-phone"></i> Teléfonos</h4>
                                        <div class="telefonos-list">
                                            @foreach($socio->telefonos as $telefono)
                                                @if(!empty($telefono->telefono))
                                                    <div class="telefono-item">
                                                        <span class="telefono-number">{{ $telefono->telefono }}</span>
                                                        <div class="telefono-actions">
                                                            <a href="tel:{{ str_replace(' ','',$telefono->telefono) }}" class="btn-telefono btn-call"><i class="fas fa-phone"></i></a>
                                                            @if(Str::startsWith($telefono->telefono, ['6','7']))
                                                                <a href="https://wa.me/+34{{ str_replace(' ','',$telefono->telefono) }}" class="btn-telefono btn-whatsapp"><i class="fab fa-whatsapp"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-actions">
                                @if($socio->alta_baja == 0)
                                    <a href="socios-edit/{{ $socio->id }}" class="btn-card btn-edit"><i class="fas fa-edit"></i><span>Ver/Editar</span></a>
                                @else
                                    <a href="socios-alta/{{ $socio->id }}" class="btn-card btn-alta"><i class="fas fa-user-plus"></i><span>Dar de alta</span></a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="datatable-wrapper">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" wire:ignore>
                
                    <thead>
                        <tr>
                            @mobile
                            <th scope="col">Pant y Matrícula</th>
                            @elsemobile
                            <th scope="col">Foto</th>
                            <th scope="col">Pantalán y Atraque</th>
                            <th scope="col">Matrícula</th>
                            @endmobile
                            <th scope="col">Nombre del Barco @mobile<br>@endmobile</th>
                            <th scope="col">Nombre del Socio  @mobile <br>@endmobile</th>
                            <th scope="col">Teléfono @mobile<br>@endmobile</th>
                            <th scope="col">Situación de persona @mobile <br>@endmobile</th>
                            <th scope="col">Acciones @mobile<br>@endmobile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            <tr>
                                @notmobile
                                <td>
                                    @if($socio->ruta_foto)
                                    <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}"
                                    loading="lazy" style="max-width: 50px !important; text-align: center">
                                    @endif
                                </td>
                                <td>{{ $socio->pantalan_t_atraque }}</td>
                                <td>{{ $socio->matricula }}</td>
                                @endnotmobile
                                @mobile
                                <th scope="col">
                                    @if($socio->ruta_foto)
                                    <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}"
                                    loading="lazy" style="max-width: 50px !important; text-align: center">
                                    @endif
                                    @switch($socio->club_id)
                                    @case(1)
                                        SL
                                        @break
                                    @case(2)
                                        RS
                                        @break
                                    @case(3)
                                        PR
                                        @break
                                    @case(4)
                                        MR
                                        @break
                                    @case(5)
                                        RL
                                        @break
                                    @default
                                @endswitch
                                -{{ $socio->pantalan_t_atraque }}-{{ $socio->matricula }}</th>
                                @endmobile
                                <td>{{ $socio->nombre_barco }}</td>
                                <td>{{ $socio->nombre_socio }}</td>
                                <td>
                                    @if($socio->telefonos->first())
                                    {{ $socio->telefonos->first()->telefono }}
                                    @endif
                                </td>
                                <td>
                                    @if ($socio->situacion_persona == 0)
                                        Socio
                                    @elseif ($socio->situacion_persona == 1)
                                        Transeúnte
                                    @else
                                        Socio/Transeúnte
                                    @endif
                                </td>
                                @mobile
                                <td> @if($socio->alta_baja == 0) <a href="socios-edit/{{ $socio->id }}" class="btn btn-primary">Ver/Editar</a> <br>@else <a href="socios-alta/{{ $socio->id }}" class="btn btn-primary">Dar de alta</a><br> @endif
                                    @if($socio->telefonos->isNotEmpty())
                                    @foreach($socio->telefonos as $telefono)
                                        @if(!empty($telefono->telefono))
                                            <a href="tel:{{ str_replace(" ","",$telefono->telefono) }}" class="btn btn-info mt-2">Llamar a {{ $telefono->telefono }}</a>
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                                @foreach($socio->telefonos as $telefono)
                                @if(Str::startsWith($telefono->telefono, ['6', '7']))
                                    <a href="https://wa.me/+34{{ str_replace(" ","",$telefono->telefono) }}" class="btn btn-success mt-2">WhatsApp a {{ ($telefono->telefono) }}</a><br>
                                @endif
                            @endforeach
                                </td>
                                @elsemobile
                                <td>
                                    @if($socio->alta_baja == 0) <a href="socios-edit/{{ $socio->id }}" class="btn btn-primary">Ver/Editar</a> @else <a href="socios-alta/{{ $socio->id }}" class="btn btn-primary">Dar de alta</a> @endif

                                </td>
                                @endmobile
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h6 class="text-center">No se encuentran socios disponibles</h6>
    @endif

</div>

<script>
// Filtro de cards en móvil (igual que Clubes/Usuarios)
(function(){
  function norm(s){
    return (s||'')
      .toString()
      .toLowerCase()
      .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
      .replace(/[-_]+/g,' ')
      .replace(/\s+/g,' ')
      .trim();
  }
  document.addEventListener('input', function(e){
    if(e.target && e.target.id === 'mobile-search-input'){
      const q = (e.target.value || '').toString();
      const query = norm(q);
      let shown = 0, total = 0;
      document.querySelectorAll('#mobile-cards .socio-card').forEach(function(card){
        total++;
        const data = card.getAttribute('data-search') || '';
        const haystack = norm((data + ' ' + card.textContent) || '');
        const match = !query || haystack.includes(query);
        if (match) {
          card.classList.remove('is-hidden');
          card.style.display = '';
          shown++;
        } else {
          card.classList.add('is-hidden');
          card.style.display = 'none';
        }
      });
      console.log('[todos-socios] filter=', q, 'normalized=', query, 'cards shown/total=', shown, '/', total);
    }
  });
})();
</script>

