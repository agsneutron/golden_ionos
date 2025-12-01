<div class='table-responsive' >
    <table id='dataTableHarvest' class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Sucursal</th>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estatus</th>
            <th>Comentarios</th>
            <th>Cliente</th>
            <th>Dirección</th>
            <th>Fraccionamiento</th>
            <th>Teléfono</th>    
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($pickups as $pickup)
            <tr>
                <td>{{ $n }}</td>
                <td>
                    <button type='button' class='btn btn-danger btn-block' onclick="reschedule({{ $pickup['Id'] }})">
                        <i class='fa fa-repeat'></i> Reprogramar
                    </button> 
                </td>
                <td>{{ $pickup['NameBranch'] }}</td>
                <td>{{ $pickup['Series'].'-'.$pickup['Folio'] }}</td>
                <td>{{ $pickup['DayPickup'] }}</td>
                <td>{{ $pickup['TimePickup'] }}</td>
                <td>{{ $pickup['OrderStatus'] }}</td>
                <td>{{ $pickup['HarvestComments'] }}</td>
                <td>{{ $pickup['NameClient'] }}</td>
                <td>{{ $pickup['AddressClient'] }}</td>
                <td>{{ $pickup['SuburbClient'] }}</td>
                <td>{{ $pickup['PhoneClient'] }}</td>                
                <?php $n++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableHarvest').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //{ extend: 'copy'},
                //{extend: 'csv'},
                {extend: 'excel', title: 'Recolecciones'},
                {extend: 'pdf', title: 'Recolecciones'},

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
