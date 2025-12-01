<div class='table-responsive' >
    <table id='dataTableUsuarios' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Sucursal</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($users as $user)
            <tr>
                <td>{{ $n }}</td>
                <td><div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick='editUser({{ $user['Id'] }},this)'>Editar</a></li>
                            <li><a href="javascript:void(0)" onclick='changePasswordUser({{ $user['Id'] }},this)'>Cambiar contraseña</a></li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-danger" href="javascript:void(0)" onclick='deleteUser({{ $user['Id'] }},this)'>Eliminar</a>
                            </li>
                        </ul>
                    </div></td>
                <td>{{ $user['user_type_description'] }}</td>
                <td>{{ $user['Name'] }}</td>
                <td>{{ $user['Email'] }}</td>
                <td>{{ $user['Phone'] }}</td>
                <td>{{ $user['NameBranch'] }}</td>
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
