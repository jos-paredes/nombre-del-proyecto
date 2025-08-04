@extends('layouts.minimal')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3><i class="fas fa-cog"></i> Panel de Parámetros</h3>
            </div>

            <div class="card-body">
                @if(empty($jsonData) || !is_array($jsonData))
                    <div class="alert alert-danger">
                        Error: Los datos no están en el formato correcto.
                    </div>
                @else
                    <!-- Pestañas -->
                    <ul class="nav nav-tabs" id="paramTabs" role="tablist">
                        @foreach(['DatosIniciales', 'MP', 'Colorante', 'Defectos', 'Temperatura'] as $section)
                            @if(isset($jsonData[$section]))
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                       id="{{ $section }}-tab"
                                       data-bs-toggle="tab"
                                       href="#{{ $section }}">
                                        {{ ucfirst($section) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <!-- Contenido -->
                    <div class="tab-content p-3 border border-top-0" id="paramTabsContent">
                        @foreach(['DatosIniciales', 'MP', 'Colorante', 'Defectos', 'Temperatura'] as $section)
                            @if(isset($jsonData[$section]))
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="{{ $section }}"
                                     role="tabpanel">

                                    <div class="row">
                                        @foreach($jsonData[$section] as $key => $values)
                                            <div class="col-md-6 mb-4">
                                                <div class="card h-100">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">{{ $key }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        @if(is_array($values))
                                                            <ul class="list-group">
                                                                @foreach($values as $value)
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        {{ is_array($value) ? implode(', ', $value) : $value }}
                                                                        <div>
                                                                            <button class="btn btn-sm btn-warning edit-btn"
                                                                                    data-section="{{ $section }}"
                                                                                    data-key="{{ $key }}"
                                                                                    data-value="{{ is_array($value) ? json_encode($value) : $value }}">
                                                                                <i class="fas fa-edit"></i>
                                                                            </button>
                                                                            <button class="btn btn-sm btn-danger delete-btn"
                                                                                    data-section="{{ $section }}"
                                                                                    data-key="{{ $key }}"
                                                                                    data-value="{{ is_array($value) ? json_encode($value) : $value }}">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p>{{ $values }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-sm btn-success add-btn"
                                                                data-section="{{ $section }}"
                                                                data-key="{{ $key }}">
                                                            <i class="fas fa-plus"></i> Agregar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('parametros._modal_form')
@endsection
