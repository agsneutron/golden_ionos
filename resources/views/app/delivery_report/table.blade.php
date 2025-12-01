<div class='table-responsive' >
    <table id='dataTableDeliveries' class='table table-striped table-bordered table-hover'>
        <thead>
            <tr>
                <th>#</th>
                <th>Orden</th>
                <th>Servicio</th>
                <th>Color</th>                
                <th>Cantidad</th>
                <th>Ubicación</th>            
                <th>Comentarios</th>            
            </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($orders as $order)
                @foreach($order['order_details'] as $order_detail)
                    <tr>
                        <td>{{ $n }}</td>
                        <td >{{ $order['Series']."-".$order['Folio'] }}</td>
                        <td >{{ $order_detail['DescriptionService'] }}</td>
                        <td >{{ $order_detail['DescriptionColor'] }}</td>                        
                        <td align="right">{{ $order_detail['Quantity'] }}</td>
                        <td >{{ $order_detail['Location'] }}</td>
                        <td >{{ $order_detail['Observations'] }}</td>                        
                    </tr>
                    <?php $n++; ?>
                @endforeach 
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableDeliveries').DataTable({
            pageLength: -1,
            responsive: true,
            lengthChange: false,
            ordering: false,
            searching: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Entregas'},
                {extend: 'pdf', title: 'Entregas'},

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
    });
</script>
