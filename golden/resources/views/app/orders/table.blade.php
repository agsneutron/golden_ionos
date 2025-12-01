<div class='table-responsive' >
        <table id='dataTableOrders' class='table table-striped table-bordered table-hover'>
            <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Folio</th>
                <th>Estatus</th>
                <th>Prioridad</th>
                <th>Recepción</th>
                <th>Entrega</th>
                <th>Cliente</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Pagado</th>
            </tr>
            </thead>
            <tbody>
            <?php $n = 1; ?>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $n }}</td>
                    <td><div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <!--<li><a href="javascript:void(0)" onclick='editOrder({ { $order['Id'] }},this)'>Editar</a></li>-->
                                <li><a href="javascript:void(0)" onclick='loadDetailOrder({{ $order['Id'] }},this)'>Ver detalle</a></li>
                                @if($order['IdOrderStatus'] > 1 && $order['IdOrderStatus'] < 6)
                                <li>
                                    <a href="javascript:void(0)"
                                       onclick='registerPayment({{ $order['Id'] }},this)'>
                                        Regisgtrar pago
                                    </a>
                                </li>
                                @endif
                                @if($order['IdOrderStatus'] == 4)
                                <li><a href="javascript:void(0)" onclick='programDelivery({{ $order['Id'] }},this)'>Programar entrega</a></li>
                                @endif
                            </ul>
                        </div></td>
                    <td>{{ $order['Series'].'-'.$order['Folio'] }}</td>
                    <td align="center" style="background-color: {{ $order['Color'] }}; color: #ffffff" >
                        <strong>{{ $order['OrderStatus'] }}</strong>
                    </td>
                    <td align="center">{{ $order['DescriptionPriority'] }}</td>
                    <td align="center">{{ $order['ReceptionDate'] }}<br>{{ $order['ReceptionTime'] }}</td>
                    <td align="center">{{ $order['DeliveryDate'] }}<br>{{ $order['DeliveryTime'] }}</td>
                    <td align="center">{{ $order['NameClient'] }}</td>
                    <td align="right">{{ number_format($order['Subtotal'],2,'.',',') }}</td>
                    <td align="right">{{ number_format($order['Discount'],2,'.',',') }}</td>
                    <td align="right">{{ number_format($order['Total'],2,'.',',') }}</td>
                    <td align="right">{{ number_format($order['AmountPaid'],2,'.',',')  }}</td>
                    <?php $n++; ?>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
    <script>
        $(document).ready(function() {
            $('#dataTableOrders').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    //{ extend: 'copy'},
                    //{extend: 'csv'},
                    {extend: 'excel', title: 'Ordenes'},
                    {extend: 'pdf', title: 'Ordenes'},
    
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
    