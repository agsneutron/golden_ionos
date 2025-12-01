<div class='table-responsive' >
    <table id='dataTableClients' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th>Sucursal</th>
            <th>Cliente</th>
            <th>Total del periodo</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($sales as $sale)
            <tr>
                <td>{{ $n }}</td>
                <td>{{ $sale['NameBranch'] }}</td>
                <td>{{ $sale['NameClient'] }}</td>
                <td align="right">$ {{ number_format($sale['TotalClient'],2,'.',',')  }}</td>
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableClients').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Ventas'},
                {extend: 'pdf', title: 'Ventas'},

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
