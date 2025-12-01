@extends('layouts.app')

@section('content')

    <div class='row' id="mainDiv">
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Recolecciones</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='registerHarvest(this)'>
                                <i class="fa fa-calendar"></i> Registrar recolección
                            </button>
                        </div>
                        <div class='col-lg-3'>
                            @if(Auth::user()->id_branch_office == null)
                            <div class="form-group" >
                                <label>Sucursal:</label>
                                <select name="filterBranchOffice" id="filterBranchOffice" class="form-control">
                                    <option value="0">Seleccione...</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type='button' class='btn btn-primary btn-block' onclick='searchHarvest()'>
                                <i class='fa fa-search'></i> Consultar
                            </button>
                            @endif
                        </div>
                        <div class='col-lg-9' id='divHarvest'></div>
                        <div class='col-lg-12' id='divTableHarvest'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EXPENSE -->
    <div class='modal inmodal' id='modalRegisterHarvest' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalRegisterHarvest'>Registrar entrega</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmRegisterHarvest' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-5">
                                <input type='hidden' id='Id' name='Id' value="0">  
                                <div class="form-group" >
                                    <label>Sucursal:</label>
                                    <select name="IdBranchOffice" id="IdBranchOffice" class="form-control" required>
                                        <option value="0">Seleccione...</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>                     
                                <div class="form-group">
                                    <label>Cliente: <span class='text-danger'>(*)</span></label>
                                    <a href="javascript:void(0)" onclick="showFormNewClient()"><i class="fa fa-user-plus"></i> Nuevo</a>
                                    <select data-placeholder="Selecciona un cliente..." id="IdClientUser" name="IdClientUser" class="chosen-select">
                                        <option value="0">Seleccione...</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client['Id'] }}">{{ $client['Name'] }}</option>
                                        @endforeach
                                        <option value="9999">Nuevo</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Recolector: <span class='text-danger'>(*)</span></label>
                                    <select data-placeholder="Selecciona un repartidor..." id="IdAssignedUser" name="IdAssignedUser" class="chosen-select">
                                        <option value="0">Seleccione...</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user['Id'] }}">{{ $user['Name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Fecha: <span class='text-danger'>(*)</span></label>
                                    <input class="form-control" type="date" id="DayPickup" name="DayPickup">
                                </div>
                                <div class="form-group">
                                    <label>Hora de recoleccion: <span class='text-danger'>(*)</span></label>
                                    <input class="form-control" type="time" id="TimePickup" name="TimePickup" value="12:00">
                                </div>
                                <div class="form-group">
                                    <label>Comentarios: <span class='text-danger'>(*)</span></label>
                                    <input class="form-control" type="text" id="Comments" name="Comments">
                                </div>
                            </div>
                            <div class="col-lg-7" id="divClientData">
                                <h3 class="text-info">Datos del cliente</h3>
                                <div class="form-group">
                                    <label>Nombre: <span class='text-danger'>(*)</span></label>
                                    <input name='Name' id='Name' type='text' class='form-control'>
                                </div>
                                <div class="form-group">
                                    <label>Teléfono: <span class='text-danger'>(*)</span></label>
                                    <input name='Phone' id='Phone' type='text' class='form-control'>
                                </div>
                                <div class="form-group">
                                    <label>Dirección: <span class='text-danger'>(*)</span></label>
                                    <input name='Address' id='Address' type='text' class='form-control'>
                                </div>                                
                                <div class="form-group">
                                    <label>Fraccionamiento: <span class='text-danger'>(*)</span></label>
                                    <input name='Suburb' id='Suburb' type='text' class='form-control'>
                                </div>                                
                                <a href="javascript:void(0)" class="text-danger" onclick="cancelFormNewClient()"><i class="fa fa-times"></i> Cancelar</a>
                            </div>
                        </div>                       
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveRegisterHarvest()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        filterBranchOffice = 0;
        @if(Auth::user()->id_branch_office != null)
            filterBranchOffice = parseInt('{{ Auth::user()->id_branch_office }}');
            $("#IdBranchOffice").val(filterBranchOffice);
        @endif

        dia = "";
        orderSelected = 0;
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            //loadTableColors()
            $("#divClientData").hide();

            $("#IdClientUser").change(function(){
                if(parseInt($("#IdClientUser").find(":selected").val()) == 9999 ){
                    $("#divClientData").show();
                }else{
                    $("#divClientData").hide();
                }
            });


            var mem = $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });


            @if(Auth::user()->id_branch_office != null)
                searchDeliveries();
            @endif

        });


        @if(Auth::user()->id_branch_office == null)
        function searchHarvest(){
            filterBranchOffice = $("#filterBranchOffice").find(':selected').val();
            $("#IdBranchOffice").val(filterBranchOffice);
            $("#divTableHarvest").empty();
            $("#divHarvest").html('<div id="calendar"></div>');
            $.post("{{ route('harvest.searchHarvest') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: $("#filterBranchOffice").find(':selected').val()
                },
                function (result) {
                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        dayClick: function(date, jsEvent, view) {
                            clickOnDate(date, jsEvent, view);
                        },
                        eventClick: function(calEvent, jsEvent, view) {
                            //clickOnEvent(calEvent, jsEvent, view)
                        },
                        editable: true,
                        droppable: false, // this allows things to be dropped onto the calendar
                        drop: function() {
                            // is the "remove after drop" checkbox checked?
                            if ($('#drop-remove').is(':checked')) {
                                // if so, remove the element from the "Draggable Events" list
                                $(this).remove();
                            }
                        },
                        events: result.events
                    });
                    //$("#municipalities").hide();
                    //$("#diary").show();
                },'json'
            );
        }
        @else
        function searchHarvest(){
            $("#divTableHarvest").empty();
            $("#divHarvest").html('<div id="calendar"></div>');
            $.post("{{ route('harvest.searchHarvest') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: $("#filterBranchOffice").find(':selected').val()
                },
                function (result) {
                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        dayClick: function(date, jsEvent, view) {
                            clickOnDate(date, jsEvent, view);
                        },
                        eventClick: function(calEvent, jsEvent, view) {
                            //clickOnEvent(calEvent, jsEvent, view)
                        },
                        editable: true,
                        droppable: false, // this allows things to be dropped onto the calendar
                        drop: function() {
                            // is the "remove after drop" checkbox checked?
                            if ($('#drop-remove').is(':checked')) {
                                // if so, remove the element from the "Draggable Events" list
                                $(this).remove();
                            }
                        },
                        events: result.events
                    });
                    //$("#municipalities").hide();
                    //$("#diary").show();
                },'json'
            );
        }
        @endif

        function showFormNewClient(){
            $("#IdClientUser").val(9999);
            $('.chosen-select').trigger('chosen:updated');
            $("#divClientData").show();
        }

        function cancelFormNewClient(){
            $("#IdClientUser").val(0);
            $('.chosen-select').trigger('chosen:updated');
            $("#divClientData").hide();
        }

        function registerHarvest(e){
            $(e).blur();
            $('#titleModalRegisterHarvest').html('Registrar recolección');
            resetForm('frmRegisterHarvest');
            $('#Id').val(0);
            $('#modalRegisterHarvest').modal('show');
        }

        function editHarvest(cve,e){
            $(e).blur();
            resetForm('frmExpense');
            $('#titleModalExpense').html('Editar gasto');
            $.post('{{ route('expenses.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmExpense').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalExpense').modal('show');
            });
        }

        function saveRegisterHarvest(){
            // @ if(Auth::user()->id_branch_office != null)
            //     $("#IdBranchOffice").val(filterBranchOffice);
            // @ endif

            $('#frmRegisterHarvest').form('submit', {
                url: "{{ route('harvest.save') }}",
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmRegisterHarvest');
                        searchHarvest();
                        $('#modalRegisterHarvest').modal('hide');
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }


        function clickOnDate(date, jsEvent, view) {
            @if(Auth::user()->id_branch_office != null)
                filterBranchOffice = parseInt('{{ Auth::user()->id_branch_office }}');
            @else
                filterBranchOffice = $("#filterBranchOffice").find(':selected').val();
            @endif

            dia = date.format();
            // console.log(dia);

            $('#divTableHarvest').load("{{ route('harvest.load_table') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: filterBranchOffice,
                    dia: dia
                },function(){
                    window.scrollTo(0,document.body.scrollHeight);
                });
        }

        function reschedule(id){
            $.ajax({
                type: "POST",
                url: "{{ route('harvest.reschedule') }}",
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                dataType: 'json',
                success : function(data) {
                    if(data.success){
                        swal ( "Correcto" ,  data.message ,  "success" );
                        searchHarvest();
                        $('#divTableHarvest').load("{{ route('harvest.load_table') }}",
                        {
                            _token: '{{ csrf_token() }}',
                            cve: filterBranchOffice,
                            dia: dia
                        },function(){
                            window.scrollTo(0,document.body.scrollHeight);
                        });
                    }else{
                        swal("Error", data.errorMsg, "error");
                    }
                }
            });
        }


    </script>

@endsection