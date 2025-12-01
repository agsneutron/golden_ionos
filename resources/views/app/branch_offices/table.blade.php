<div class='table-responsive' >
    <table id='dataTableBranchOffices' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>C.P.</th>
            <th>Teléfono</th>
            <th>Serie</th>
            <th>Folio actual</th>
            <th>RFC</th>
            <th>Email</th>
            <th>Leyenda</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($branchs as $branch)
            <tr>
                <td>{{ $n }}</td>
                <td><div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick='editBranchOffice({{ $branch['Id'] }},this)'>Editar</a></li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-danger" href="javascript:void(0)" onclick='deleteBranchOffice({{ $branch['Id'] }},this)'>Eliminar</a>
                            </li>
                        </ul>
                    </div></td>
                <td>{{ $branch['Name'] }}</td>
                <td>{{ $branch['Address'] }}</td>
                <td>{{ $branch['PostalCode'] }}</td>
                <td>{{ $branch['Phone'] }}</td>
                <td>{{ $branch['Series'] }}</td>
                <td>{{ $branch['CurrentSheet'] }}</td>
                <td>{{ $branch['Rfc'] }}</td>
                <td>{{ $branch['Email'] }}</td>
                <td>{{ $branch['Legend'] }}</td>
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableBranchOffices').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Sucursales'},
                {extend: 'pdf', title: 'Sucursales'},

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
