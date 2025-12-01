<div class="col-lg-12">
    <div class='table-responsive' >
        <table id='dataTablePayments' class='table table-striped table-bordered table-hover'>
            <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Metodo de pago</th>
                <th>Monto</th>
                <th>Fecha</th>
                @if(Auth::user()->id_user_type < 3)
                    <th>Estatus</th>
                @endif
            </tr>
            </thead>
            <tbody>
            <?php $n = 1; ?>
            @foreach($payments as $payment)
                <tr>
                    <td style="{{ $payment['DeletedPayment'] == 1 ? 'border-left: 5px solid #ed5565' : '' }}" >{{ $n }}</td>
                    <td align="center">
                        @if($payment['DeletedPayment'] == 0 && Auth::user()->id_user_type < 3 && $payment['OrderStatus'] < 6)
                        <button type='button' class="btn btn-danger btn-sm " onclick="deletePayment({{ $payment['Id'] }},this)">
                            <i class="fa fa-times"></i>
                        </button>
                        @endif
                    </td>
                    <td align="center">{{ $payment['DescriptionPayment'] }}<br> 
                        {{-- @ if($payment['OrderStatus'] < 6)
                        <button type='button' class="btn btn-white btn-xs" onclick="changePaymentMethod({{ $payment['Id'] }}, {{ $payment['IdPaymentMethod'] }},this)">
                            Cambiar
                        </button>
                        @endif --}}
                    </td>
                    <td align="right">{{ $payment['AmountPaid'] }}</td>
                    <td >{{ $payment['CreatedAt'] }}</td>
                    @if(Auth::user()->id_user_type < 3)
                        <td>
                            @if($payment['DeletedPayment'] == 1)
                                <strong class="text-danger">Eliminado</strong>
                            @endif
                        </td>
                    @endif
                    <?php $n++; ?>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTablePayments').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Pagos'},
                {extend: 'pdf', title: 'Pagos'},

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
