<div class='table-responsive' >
    <div class="col-lg-6">
        <button type='button' class='btn btn-outline btn-white' onclick='loadTableCategories()'>
            <i class="fa fa-arrow-left"></i> Regresar
        </button>
    </div>
    <div class="col-lg-6" align="right">
        <button type='button' class='btn btn-outline btn-white' onclick='newService(this)'>
            <i class="fa fa-plus"></i> Nuevo servicio
        </button>
        <button type='button' class='btn btn-outline btn-white' onclick='unifyServices(this)'>
            <i class="fa fa-cubes"></i> Unificar servicios
        </button>
    </div>
    <table id='dataTableServices' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th></th>
            <th>Categoria</th>
            <th>Descripción</th>
            <th>Precio normal</th>
            <th>Precio urgente</th>
            <th>Precio extra urgente</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($services as $service)
            <tr data-id="{{$service['Id'] }}">
                <td>{{ $n }}</td>
                <td></td>
                <td><div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick='editService({{ $service['Id'] }},this)'>Editar</a></li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-danger" href="javascript:void(0)" onclick='deleteService({{ $service['Id'] }},this)'>Eliminar</a>
                            </li>
                        </ul>
                    </div></td>
                <td>{{ $service['CategoryName'] }}</td>
                <td>{{ $service['Description'] }}</td>
                <td>{{ $service['NormalPrice'] }}</td>
                <td>{{ $service['UrgentPrice'] }}</td>
                <td>{{ $service['ExtraUrgentPrice'] }}</td>
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableServices').DataTable({
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
                {extend: 'excel', title: 'Servicios'},
                {extend: 'pdf', title: 'Servicios'},

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
