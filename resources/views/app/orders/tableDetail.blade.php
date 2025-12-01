<div class="col-lg-12">
    <div class='table-responsive' >
        <table id='dataTableDetailOrder' class='table table-striped table-bordered table-hover'>
            <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th></th>
                <th>Servicio</th>
                <th>Estatus</th>
                <th>Color</th>
                <th>Estampado</th>
                <th>Defecto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Observaciones</th>
                <th>Ubicación</th>
                <th>Fecha de engtrega</th>
                <th>Entregado por</th>
            </tr>
            </thead>
            <tbody>
            <?php $n = 1; ?>
            @foreach($details as $detail)
                <tr data-id="{{$detail['Id'] }}">
                    <td>{{ $n }}</td>
                    <td></td>
                    <td><div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @if($order['IdOrderStatus'] == 1)
                                <li><a href="javascript:void(0)" onclick='editDetail({{ $detail['Id'] }},this)'>Editar</a></li>
                                @endif
                                <li><a href="javascript:void(0)" onclick='showDetailHistory({{ $detail['Id'] }},this)'>Ver historial</a></li>
                                <li><a href="javascript:void(0)" onclick='updateStatusDetail({{ $detail['Id'] }},this)'> Actualizar estatus</a></li>
                                @if($order['IdOrderStatus'] == 1)
                                <li class="divider"></li>
                                <li>
                                    <a class="text-danger" href="javascript:void(0)" onclick='deleteDetail({{ $detail['Id'] }},this)'>Eliminar</a>
                                </li>
                                @endif
                            </ul>
                        </div></td>
                    <td >{{ $detail['DescriptionService'] }}</td>
                    <td align="center" style="background-color: {{ $detail['Color'] }}; color: #ffffff" >
                        <strong>{{ $detail['DetailStatus'] }}</strong>
                    </td>
                    <td >{{ $detail['DescriptionColor'] }}</td>
                    <td >{{ $detail['DescriptionPrint'] }}</td>
                    <td >{{ $detail['DescriptionDefect'] }}</td>
                    <td >{{ $detail['Price'] }}</td>
                    <td align="right">{{ $detail['Quantity'] }}</td>
                    <td >{{ $detail['Subtotal'] }}</td>
                    <td >{{ $detail['Discount'] }}</td>
                    <td >{{ $detail['Total'] }}</td>
                    <td >{{ $detail['Observations'] }}</td>
                    <td >{{ $detail['Location'] }}</td>
                    <td >{{ $detail['RealDeliveryDate']." ".$detail['RealDeliveryTime'] }}</td>
                    <td >{{ $detail['NameDaliveryUser'] }}</td>
                    <?php $n++; ?>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableDetailOrder').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            select: {
                style:    'multi',
                //selector: 'td:first-child',
                selector: 'td:nth-child(2)',
                //selector: 'td:not(:last-child)' // no row selection on last column
            },
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   1
            } ],
            buttons: [
                'selectAll',
                'selectNone',
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Piezas'},
                {extend: 'pdf', title: 'Piezas'},

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
                    selectNone: "Quitar todo",
                    selectAll: "Seleccionar todo",
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
