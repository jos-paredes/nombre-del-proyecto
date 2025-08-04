<div class="modal fade" id="paramModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="paramForm" method="POST" action="{{ route('parametros.save') }}">
                @csrf
                <input type="hidden" name="section" id="modalSection">
                <input type="hidden" name="key" id="modalKey">
                <input type="hidden" name="action" id="modalAction">
                <input type="hidden" name="old_value" id="modalOldValue">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Editar Parámetro</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Valor:</label>
                        <input type="text" name="value" id="modalValue" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Configurar modal para agregar
            $('.add-btn').click(function() {
                $('#modalSection').val($(this).data('section'));
                $('#modalKey').val($(this).data('key'));
                $('#modalAction').val('add');
                $('#modalOldValue').val('');
                $('#modalValue').val('');
                $('#modalTitle').text('Agregar nuevo valor');
                $('#paramModal').modal('show');
            });

            // Configurar modal para editar
            $('.edit-btn').click(function() {
                $('#modalSection').val($(this).data('section'));
                $('#modalKey').val($(this).data('key'));
                $('#modalAction').val('update');
                $('#modalOldValue').val($(this).data('value'));
                $('#modalValue').val($(this).data('value'));
                $('#modalTitle').text('Editar valor existente');
                $('#paramModal').modal('show');
            });

            // Enviar formulario para eliminar
            $('.delete-btn').click(function() {
                if (confirm('¿Eliminar este parámetro?')) {
                    $.post("{{ route('parametros.save') }}", {
                        _token: "{{ csrf_token() }}",
                        section: $(this).data('section'),
                        key: $(this).data('key'),
                        action: 'delete',
                        old_value: $(this).data('value')
                    }).then(() => location.reload());
                }
            });
        });
    </script>
@endpush
