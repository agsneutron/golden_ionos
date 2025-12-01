@extends('layouts.app')

@section('content')

    <div class='row' id="mainDiv">
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Entregas</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='registerDelivery(this)'>
                                <i class="fa fa-calendar"></i> Registrar entrega
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
                            @endif
                            <div class="form-group" >
                                <label>Estatus:</label>
                                <select name="filterStatus" id="filterStatus" class="form-control">
                                    <option value="0">Pendientes</option>
                                    <option value="1">Entregadas</option>
                                    <option value="2">Todas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Desde:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filterStartDay" name="filterStartDay" value="{{ date('Y-m') }}-01">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Hasta:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filterEndDay" name="filterEndDay" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <button type='button' class='btn btn-primary btn-block' onclick='searchDeliveries()'>
                                <i class='fa fa-search'></i> Consultar
                            </button>                            
                        </div>
                        <div class='col-lg-9' id='divDeliveries'></div>
                        <div class='col-lg-12' id='divTableDeliveries'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EXPENSE -->
    <div class='modal inmodal' id='modalRegisterDelivery' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalRegisterDelivery'>Registrar entrega</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmRegisterDelivery' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='IdBranchOffice' name='IdBranchOffice' value="0">
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Ordenes para entrega: <span class='text-danger'>(*)</span></label>
                            <select data-placeholder="Selecciona un repartidor..." id="IdOrder" name="IdOrder" class="chosen-select">
                                <option value="0">Seleccione...</option>
                                @foreach($orders as $order)
                                    <option value="{{ $order['Id'] }}">{{ $order['Series'].'-'.$order['Folio'].' - '.$order['NameClient'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Repartidor: <span class='text-danger'>(*)</span></label>
                            <select data-placeholder="Selecciona un repartidor..." id="IdAssignedUser" name="IdAssignedUser" class="chosen-select">
                                <option value="0">Seleccione...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user['Id'] }}">{{ $user['Name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Fecha: <span class='text-danger'>(*)</span></label>
                            <input class="form-control" type="date" id="DayDelivery" name="DayDelivery">
                        </div>
                        <div class="form-group">
                            <label>Comentarios: <span class='text-danger'>(*)</span></label>
                            <input class="form-control" type="text" id="Comments" name="Comments">
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveRegisterDelivery()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(Auth::user()->id_branch_office != null)
            filterBranchOffice = parseInt('{{ Auth::user()->id_branch_office }}');
        @else
            filterBranchOffice = 0;
        @endif

        dia = "";
        status = 0;
        orderSelected = 0;
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            //loadTableColors()


            var mem = $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });


            @if(Auth::user()->id_branch_office != null)
                //searchDeliveries();
            @endif
            
            searchDeliveries();

        });


        function searchDeliveries(){

            $('#divTableDeliveries').empty();

            @if(Auth::user()->id_branch_office == null)
                filterBranchOffice = $("#filterBranchOffice").find(':selected').val();
            @endif

            filterStatus = $("#filterStatus").find(':selected').val();

            $("#divDeliveries").html('<div id="calendar"></div>');
            $.post("{{ route('deliveries.searchDeliveries') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: filterBranchOffice,
                    status: filterStatus,
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val(),
                },
                function (result) {
                    console.log(result);

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

        function registerDelivery(e){
            $(e).blur();
            $('#titleRegisterDelivery').html('Registrar entrega');
            resetForm('frmRegisterDelivery');
            $('#Id').val(0);
            $('#modalRegisterDelivery').modal('show');
        }

        function editExpense(cve,e){
            $(e).blur();
            resetForm('frmExpense');
            $('#titleModalExpense').html('Editar gasto');
            $.post("{{ route('expenses.edit') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmExpense').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalExpense').modal('show');
            });
        }

        function saveRegisterDelivery(){
            @if(Auth::user()->id_branch_office != null)
                $("#IdBranchOffice").val(filterBranchOffice);
            @endif

            $('#frmRegisterDelivery').form('submit', {
                url: '{{ route('deliveries.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmRegisterDelivery');
                        searchDeliveries();
                        $('#modalRegisterDelivery').modal('hide');
                        if(dia != ""){
                            loadTableDeliveries();
                        }
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }


        function clickOnDate(date, jsEvent, view) {            
            dia = date.format();
            console.log(dia);

            loadTableDeliveries();
        }

        function loadTableDeliveries(){

            $('#divTableDeliveries').load("{{ route('deliveries.loadTableDeliveries') }}",
            {
                _token: '{{ csrf_token() }}',
                cve: filterBranchOffice,
                status: filterStatus,
                dia: dia
            },function(){
                window.scrollTo(0,document.body.scrollHeight);
            });
        }
        
        function changeDateDelivery(cve,e){
            $(e).blur();
            resetForm('frmOrder');
            $('#titleModalRegisterDelivery').html('Editar entrega');
            $.post("{{ route('deliveries.edit') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmRegisterDelivery').form('load', result.data);
                    $('.chosen-select').trigger('chosen:updated');
                }, 'json').always(function (result) {
                $('#modalRegisterDelivery').modal('show');
            });
        }

        function cancelDelivery(cve){
            swal(
                {
                    title: '¿Desea cancelar la entrega seleccionada?',
                    text: '',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post("{{ route('deliveries.cancelDelivery')  }}",
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve
                        },function (result) {
                            console.log(result);
                            if(result.success){                            
                                swal({
                                    title: 'Entrega cancelada',
                                    text: result.errorMsg,
                                    type: "success"
                                }, function(){
                                    searchDeliveries();
                                    loadTableDeliveries();
                                });
                            }else{
                                swal("Cancelar entrega", result.errorMsg, "error");
                            }
                        },'json');
                });
        }

        function completeDelivery(cve){
            $.post("{{ route('deliveries.completeDelivery')  }}",
            {
                _token:'{{ csrf_token() }}',
                cve:cve
            },function (result) {
                console.log(result);
                if(result.success){                            
                    swal({
                        title: 'Entrega terminada',
                        text: result.errorMsg,
                        type: "success"
                    }, function(){
                        searchDeliveries();
                        loadTableDeliveries();
                    });
                }else{
                    swal("Cancelar entrega", result.errorMsg, "error");
                }
            },'json');
        }


    </script>

@endsection