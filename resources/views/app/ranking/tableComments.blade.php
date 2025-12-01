<div class='table-responsive' >
    <table id='dataTableComments' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th>Sucursal</th>
            <th>Orden</th>
            <th>Comentarios</th>
            <th>Calificación</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($orders as $order)
            <tr>
                <td>{{ $n }}</td>
                <td>{{ $order['NameBranch'] }}</td>                
                <td>{{ $order['Series']."-".$order['Folio'] }}</td>                
                <td>{{ $order['ClientComments'] }}</td>                
                <td>{{ $order['Rank'] }}</td>                
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableComments').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Comentarios'},
                {extend: 'pdf', title: 'Comentarios'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
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
