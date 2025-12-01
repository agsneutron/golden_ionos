<div class='table-responsive' >
    <table id='dataTablePurses' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Código</th>
            <th>Monto</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($purses as $purse)
            <tr>
                <td>{{ $n }}</td>
                <td><div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick="editPurse({{ $purse['Id'] }},this)">Editar</a></li>
                            <li><a href="javascript:void(0)" onclick="addAmountToPurse({{ $purse['Id'] }},this)">Agregar monto</a></li>
                            <li><a href="javascript:void(0)" onclick="showPurseHistory({{ $purse['Id'] }},this)"">Ver historial</a></li>
                            <li><a href="javascript:void(0)" onclick="deletePurse({{ $purse['Id'] }},this)">Eliminar</a></li>
                        </ul>
                    </div></td>
                <td>{{ $purse['NameClient'] }}</td>
                <td>{{ $purse['AddressClient'] }}</td>
                <td>{{ $purse['Code'] }}</td>
                <td>{{ $purse['Amount'] }}</td>
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTablePurses').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Defectos'},
                {extend: 'pdf', title: 'Defectos'},

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
