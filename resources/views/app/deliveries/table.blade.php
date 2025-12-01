<div class='table-responsive' >
    <table id='dataTableDeliveries' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Sucursal</th>
            <th>Folio</th>
            <th>Fecha actual</th>
            <th>Estatus orden</th>
            <!-- <th>Estatus entrega</th> -->
            <th>Cliente</th>
            <th>Dirección</th>
            <th>Fraccionamiento</th>
            <th>Teléfono</th>
            <th>Total</th>
            <th>Pagado</th>
            <th>Restante</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($deliveries as $delivery)
            <tr>
                <td>{{ $n }}</td>
                <td>
                    @if($delivery['Status'] == 0)
                        <!--
                        <button type='button' class='btn btn-success btn-block' onclick="completeDelivery({{ $delivery['Id'] }})">
                            <i class='fa fa-check'></i>
                        </button>
                        -->
                        <button type='button' class='btn btn-primary btn-block' onclick="changeDateDelivery({{ $delivery['Id'] }}, this)">
                            <i class='fa fa-calendar'></i>
                        </button>
                        <button type='button' class='btn btn-danger btn-block' onclick="cancelDelivery({{ $delivery['Id'] }})">
                            <i class='fa fa-times'></i>
                        </button>                        
                    @endif
                </td>
                <td align="center">{{ $delivery['NameBranch'] }}</td>
                <td align="center">{{ $delivery['Series'].'-'.$delivery['Folio'] }}</td>
                <td align="center">{{ date('Y-m-d') }}</td>
                <td align="center">{{ $delivery['OrderStatus'] }}</td>
                <!-- @if($delivery['Status'] == 0)
                <td align="center" style="background-color: #37B7CF; color: #ffffff" >
                    Pendiente
                </td>
                @else
                <td align="center" style="background-color: #9DCA48; color: #ffffff" >
                    Entregada
                </td>
                @endif -->
                <td>{{ $delivery['NameClient'] }}</td>
                <td>{{ $delivery['AddressClient'] }}</td>
                <td>{{ $delivery['SuburbClient'] }}</td>
                <td>{{ $delivery['PhoneClient'] }}</td>
                <td align="right">{{ number_format($delivery['Total'],2,'.',',')  }}</td>
                <td align="right">{{ number_format($delivery['AmountPaid'],2,'.',',')  }}</td>
                <td align="right">{{ number_format(($delivery['Total']-$delivery['AmountPaid']),2,'.',',')  }}</td>
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableDeliveries').DataTable({
            pageLength: 25,
            responsive: true,
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

        $('.tooltip-demo').tooltip({
            selector: '[data-toggle=tooltip]',
            container: 'body'
        });
    });
</script>
