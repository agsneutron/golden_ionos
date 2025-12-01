<div class='table-responsive' >
    <div class="col-lg-12" align="right">
        <button type='button' class='btn btn-outline btn-white' onclick='newCategory(this)'>
            <i class="fa fa-plus"></i> Nuevo
        </button>
    </div>
    <table id='dataTableCategories' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($categories as $category)
            <tr>
                <td>{{ $n }}</td>
                <td><div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick='editCategory({{ $category['Id'] }},this)'>Editar</a></li>
                            <li><a href="javascript:void(0)" onclick='showServices({{ $category['Id'] }},this)'>Ver servicios</a></li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-danger" href="javascript:void(0)" onclick='deleteCategory({{ $category['Id'] }},this)'>Eliminar</a>
                            </li>
                        </ul>
                    </div></td>
                <td>{{ $category['Description'] }}</td>
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableCategories').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'CategoriasDeServicios'},
                {extend: 'pdf', title: 'CategoriasDeServicios'},

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
