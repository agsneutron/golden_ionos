<div class='table-responsive' >
    <table id='dataTableDeliveries' class='table table-striped table-bordered table-hover'>
        <thead>
            <tr>
                <th>#</th>
                <th>Servicio</th>
                <th>Color</th>
                <th>Estampado</th>
                <th>Defecto</th>
                <th>Cantidad</th>
                <th>Ubicación</th>            
            </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($deliveries as $delivery)
            @if($delivery['order_details'])
                <tr>
                    <td></td>
                    <td>
                        <p>
                            <strong>Orden:   </strong>{{ $delivery['Series']."-".$delivery['Folio'] }}<br>
                            <strong>Repartidor:   </strong>{{  $delivery['AssignedName'] }}<br>
                            <strong>Cliente:   </strong>{{  $delivery['NameClient'] }}<br>
                            <strong>Sucursal:   </strong>{{ $delivery['BranchName'] }}<br>
                            <strong>Prioridad:   </strong>{{  $delivery['PriorityDescription'] }}<br>
                            <strong>Fecha de entrega:   </strong>{{  $delivery['DayDelivery'] }}<br>
                            <strong>Hora de entrega:   </strong>{{  $delivery['TimeDelivery'] }}
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php $n = 1; ?>
                @foreach($delivery['order_details'] as $order_detail)
                    <tr>
                        <td>{{ $n }}</td>
                        <td >{{ $order_detail['DescriptionService'] }}</td>
                        <td >{{ $order_detail['DescriptionColor'] }}</td>
                        <td >{{ $order_detail['DescriptionPrint'] }}</td>
                        <td >{{ $order_detail['DescriptionDefect'] }}</td>
                        <td align="right">{{ $order_detail['Quantity'] }}</td>
                        <td >{{ $order_detail['Location'] }}</td>
                    </tr>
                    <?php $n++; ?>
                @endforeach 
            @endif
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
