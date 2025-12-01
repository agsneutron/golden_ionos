<div class="col-lg-12">
    <h3 class="text-info">Pagos con tarjetas bancarias</h3>
    <div class='table-responsive' >
        <table id='dataTableCardPayments' class='table table-striped table-bordered table-hover'>
            <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Usuario</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            <?php $n = 1; ?>
            @foreach($cardPayments as $payment)
                <tr>
                    <td>{{ $n }}</td>
                    <td >{{ $payment['CreatedAt'] }}</td>
                    <td >Nota {{ $payment['SeriesBranch']."-".$payment['FolioOrder'] }}</td>
                    <td >{{ $payment['NameUser'] }}</td>
                    <td align="right">{{ $payment['AmountPaid'] }}</td>
                    <?php $n++; ?>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableCardPayments').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'PagosConTarjeta'},
                {extend: 'pdf', title: 'PagosConTarjeta'},

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
