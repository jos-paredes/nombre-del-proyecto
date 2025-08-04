<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Producción</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table thead th {
            background-color: #e9ecef;
            vertical-align: middle;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px 10px;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
        .btn-group .btn:last-child {
            margin-right: 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 4px !important;
            margin: 0 2px !important;
            padding: 5px 10px !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #0d6efd !important;
            color: white !important;
            border: 1px solid #0d6efd !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e9ecef !important;
            color: #0d6efd !important;
            border: 1px solid #dee2e6 !important;
        }
    </style>
</head>
<body>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Registros de Producción</h5>
                                <p class="mb-4">
                                    Visualización y gestión de todos los registros de producción del sistema.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-5 text-center text-md-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png"
                                     height="140"
                                     alt="Producción"
                                     class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title">Detalle de Registros</h5>
                        <div class="d-flex flex-wrap">
                            <button class="btn btn-secondary mb-2 me-2" onclick="$('#registrosTable').DataTable().button('.buttons-copy').trigger()">
                                <i class="fas fa-copy me-1"></i>Copiar
                            </button>
                            <button class="btn btn-success mb-2 me-2" onclick="$('#registrosTable').DataTable().button('.buttons-excel').trigger()">
                                <i class="fas fa-file-excel me-1"></i>Excel
                            </button>
                            <button class="btn btn-info mb-2 me-2" onclick="$('#registrosTable').DataTable().button('.buttons-csv').trigger()">
                                <i class="fas fa-file-csv me-1"></i>CSV
                            </button>
                            <button class="btn btn-danger mb-2 me-2" onclick="$('#registrosTable').DataTable().button('.buttons-pdf').trigger()">
                                <i class="fas fa-file-pdf me-1"></i>PDF
                            </button>
                            <button class="btn btn-primary mb-2" onclick="$('#registrosTable').DataTable().button('.buttons-print').trigger()">
                                <i class="fas fa-print me-1"></i>Imprimir
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive text-nowrap p-3">
                        <table id="registrosTable" class="table table-borderless table-hover">
    <thead>
        <tr class="table-primary">
            <th><center>Fecha</center></th>
            <th><center>Auxiliar</center></th>
            <th><center>Turno</center></th>
            <th><center>Acciones</center></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($results as $row)
        <tr>
            <td><center>{{ \Carbon\Carbon::parse($row->updated_at)->format('Y-m-d H:i') }}</center></td>
            <td><center>{{ $row->Auxiliar }}</center></td>
            <td><center>{{ $row->Turno }}</center></td>
            <td>
                <center>
                    <div class="btn-group" role="group">
                        <a href="{{ route('registros.pdf', ['id' => $row->id, 'auxiliar' => Str::slug($row->Auxiliar)]) }}" 
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </div>
                </center>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No hay registros disponibles.</td>
        </tr>
        @endforelse
    </tbody>
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            $('#registrosTable').DataTable({
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                "iDisplayLength": 10,
                "dom": '<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "buttons": [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copiar',
                        className: 'btn btn-secondary',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        className: 'btn btn-info',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Imprimir',
                        className: 'btn btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-columns"></i> Columnas',
                        className: 'btn btn-warning'
                    }
                ],
                "language": {
                    "search": '<span class="me-2">Buscar:</span>',
                    "searchPlaceholder": "Buscar registros...",
                    "lengthMenu": "Mostrar MENU registros por página",
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando START a END de TOTAL registros",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de MAX registros totales)",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "initComplete": function() {
                    $('.dataTables_filter input').addClass('form-control form-control-sm').css({
                        'width': '300px',
                        'display': 'inline-block'
                    });
                    $('.dataTables_length select').addClass('form-control form-control-sm').css({
                        'width': '100px',
                        'display': 'inline-block'
                    });
                    
                    // Mover los botones al contenedor de DataTables
                    $('.dt-buttons').appendTo('.card-header');
                }
            });
        });
    </script>
</body>
</html>