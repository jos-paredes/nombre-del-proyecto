<!-- Modal Agregar -->
<div class="modal fade" id="addModal-{{ $section }}-{{ $key }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('parametros.save') }}" method="POST">
                @csrf
                <input type="hidden" name="section" value="{{ $section }}">
                <input type="hidden" name="key" value="{{ $key }}">
                <input type="hidden" name="action" value="add">

                <div class="modal-header">
                    <h5 class="modal-title">Agregar {{ $key }}</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="value" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editModal-{{ $section }}-{{ $key }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('parametros.save') }}" method="POST">
                @csrf
                <input type="hidden" name="section" value="{{ $section }}">
                <input type="hidden" name="key" value="{{ $key }}">
                <input type="hidden" name="action" value="update">

                <div class="modal-header">
                    <h5 class="modal-title">Editar {{ $key }}</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="old_value" id="oldValue-{{ $section }}-{{ $key }}">
                    <input type="text" name="value" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Llenar el modal de edición con los datos actuales
        $('#editModal-{{ $section }}-{{ $key }}').on('show.bs.modal', function(e) {
            const value = $(e.relatedTarget).data('value');
            $(this).find('input[name="old_value"]').val(value);
            $(this).find('input[name="value"]').val(value);
        });
    </script>
@endpush
