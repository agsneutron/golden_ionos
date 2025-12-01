<div class="col-lg-12">
    <div class='table-responsive' >
        <table id='dataTablePurseHistory' class='table table-striped table-bordered table-hover'>
            <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Orden</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            <?php $n = 1; ?>
            @foreach($records as $record)
                <tr>
                    <td>{{ $n }}</td>
                    <td >{{ $record['CreatedAt'] }}</td>
                    <td >{{ $record['Serie']."-".$record['Folio'] }}</td>
                    <td >{{ $record['Description'] }}</td>
                    <td >
                        @if($record['MovementType'] == 1)
                            <p class="text-success">Abono</p>
                        @else
                            <p class="text-danger">Retiro</p>
                        @endif
                    </td>
                    <td align="right">{{ $record['Amount'] }}</td>
                    <?php $n++; ?>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTablePurseHistory').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [

            ],
            language: {
                "search": "Buscar:",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "paginate": {
                    "first":      "Primera",
                    "last":       "Ultima",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "emptyTable":     "No existen registros",
                "info":           "Mostrando _START_ al _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 registros",
                "zeroRecords":    "Sin coincidencias",
                "infoFiltered":   "(filtrado de _MAX_ registros)",
                buttons: {
                    print: "Imprimir"
                }
            }
        });

        $('.tooltip-demo').tooltip({
            selector: '[data-toggle=tooltip]',
            container: 'body'
        });
    });
</script>
