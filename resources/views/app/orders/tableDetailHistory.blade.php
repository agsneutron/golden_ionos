<div class="col-lg-12">
    <div class='table-responsive' >
        <table id='dataTableDetailHistory' class='table table-striped table-bordered table-hover'>
            <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Descripción</th>
                <th>Usuario</th>
                <th>Imagen</th>
            </tr>
            </thead>
            <tbody>
            <?php $n = 1; ?>
            @foreach($records as $record)
                <tr>
                    <td>{{ $n }}</td>
                    <td >{{ $record['CreatedAt'] }}</td>
                    <td align="center">
                        <div style="width: 30px; height: 30px; background-color: {{ $record['Color'] }}"></div>
                        {{ $record['DescriptionStatus'] }}
                    </td>
                    <td >{{ $record['Description'] }}</td>
                    <td >{{ $record['NameUser'] }}</td>
                    <td>
                        @if( $record['Image'] != "" )
                        <img src="{{ asset('graphics/services/'.$record['Image']) }}" style="width: 150px" alt="">
                        @endif
                    </td>
                    <?php $n++; ?>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableDetailHistory').DataTable({
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
