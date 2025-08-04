@foreach($params as $key => $values)
    <div class="card my-3">
        <div class="card-header d-flex justify-content-between">
            <h5>{{ $key }}</h5>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal-{{ $section }}-{{ $key }}">
                + Agregar
            </button>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($values as $value)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $value }}
                        <div>
                            <button class="btn btn-sm btn-warning"
                                    data-toggle="modal"
                                    data-target="#editModal-{{ $section }}-{{ $key }}"
                                    data-value="{{ $value }}">
                                Editar
                            </button>
                            <form action="{{ route('parametros.save') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="section" value="{{ $section }}">
                                <input type="hidden" name="key" value="{{ $key }}">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="old_value" value="{{ $value }}">
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Modales (Agregar/Editar) -->
    @include('parametros._form', ['section' => $section, 'key' => $key])
@endforeach
