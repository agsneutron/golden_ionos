<div class='table-responsive' >
    <table id='dataTableUsuarios' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th></th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Fraccionamiento</th>
            <th>Teléfono</th>
            <th>Notas</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($users as $user)
            <tr data-id="{{$user['Id'] }}">
                <td>{{ $n }}</td>
                <td></td>
                <td><div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick='editClient({{ $user['Id'] }},this)'>Editar</a></li>
                            <li><a href="javascript:void(0)" onclick='changePasswordClient({{ $user['Id'] }},this)'>Cambiar contraseña</a></li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-danger" href="javascript:void(0)" onclick='deleteClient({{ $user['Id'] }},this)'>Eliminar</a>
                            </li>
                        </ul>
                    </div></td>
                <td>{{ $user['Name'] }}</td>
                <td>{{ $user['Email'] }}</td>
                <td>{{ $user['Address'] }}</td>
                <td>{{ $user['Suburb'] }}</td>
                <td>{{ $user['Phone'] }}</td>
                <td>{{ $user['Notes'] }}</td>
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableUsuarios').DataTable({
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
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Usuarios'},
                {extend: 'pdf', title: 'Usuarios'},

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
