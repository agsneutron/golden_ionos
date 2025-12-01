@extends('layouts.app')

@section('content')

    <div class='row' id="mainDiv">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Ordenes recibidas hoy</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4" align="center">
                            <h2 class="text-info">
                                <small>Normal</small>
                                <br>
                                <strong id="RecivedTodayNormal">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-warning">
                                <small>Urgente</small>
                                <br>
                                <strong id="RecivedTodayUrgen">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-danger">
                                <small>Extra-urgente</small>
                                <br>
                                <strong id="RecivedTodayExtra">
                                    -
                                </strong>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Ordenes atrasadas</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4" align="center">
                            <h2 class="text-info">
                                <small>Normal</small>
                                <br>
                                <strong id="BackorderNormal">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-warning">
                                <small>Urgente</small>
                                <br>
                                <strong id="BackorderUrgen">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-danger">
                                <small>Extra-urgente</small>
                                <br>
                                <strong id="BackorderExtra">
                                    -
                                </strong>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Ordenes para entregar hoy</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4" align="center">
                            <h2 class="text-info">
                                <small>Normal</small>
                                <br>
                                <strong id="DeliveredTodayNormal">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-warning">
                                <small>Urgente</small>
                                <br>
                                <strong id="DeliveredTodayUrgen">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-danger">
                                <small>Extra-urgente</small>
                                <br>
                                <strong id="DeliveredTodayExtra">
                                    -
                                </strong>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Ordenes con mas de 60 días</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4" align="center">
                            <h2 class="text-info">
                                <small>Normal</small>
                                <br>
                                <strong id="LongTimeNormal">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-warning">
                                <small>Urgente</small>
                                <br>
                                <strong id="LongTimeUrgen">
                                    -
                                </strong>
                            </h2>
                        </div>
                        <div class="col-lg-4" align="center">
                            <h2 class="text-danger">
                                <small>Extra-urgente</small>
                                <br>
                                <strong id="LongTimeExtra">
                                    -
                                </strong>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Ordenes</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-info  dim btn-lg btn-outline' onclick='openModalSearchOrder(this)'>
                                <i class="fa fa-search"></i> Buscar por código
                            </button>
                            <button type='button' class='btn btn-info  dim btn-lg btn-outline' onclick='newOrder(this)'>
                                <i class="fa fa-plus"></i> Nueva orden
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
                                    <option value="0">Seleccione...</option>
                                    @foreach($status as $stat)
                                        <option value="{{ $stat['Id'] }}">{{ $stat['Description'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Desde:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filterStartDay" name="filterStartDay" value="{{ date('Y-m-d') }}">
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

                            <button type='button' class='btn btn-primary btn-block' onclick='searchOrders()'>
                                <i class='fa fa-search'></i> Consultar
                            </button>
                        </div>
                        <div class='col-lg-9' id='divTableOrders'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL  -->
    <div class='modal inmodal' id='modalSearchOrder' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title'>Escanear código</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Posicionate en el campo inferior y escanea el código de barras</p>
                    </div>
                    <div class="form-group">
                        <label>Código: <span class='text-danger'>(*)</span></label>
                        <input class="form-control" type="text" id="orderCode" name="orderCode" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ARTICLE -->
    <div class='modal inmodal' id='modalOrder' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalOrder'>Nuevo color</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmOrder' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-5">
                                <input type='hidden' id='Id' name='Id' value="0">
                                @if(Auth::user()->id_branch_office != null)
                                    <input type='hidden' id='IdBranchOffice' name='IdBranchOffice' value="0">
                                @else
                                    <div class="form-group" >
                                        <label>Sucursal:</label>
                                        <select name="IdBranchOffice" id="IdBranchOffice" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif                                
                                <div class="form-group">
                                    <label>Cliente: <span class='text-danger'>(*)</span></label>
                                    <a href="javascript:void(0)" onclick="showFormNewClient()"><i class="fa fa-user-plus"></i> Nuevo</a>
                                    <select data-placeholder="Selecciona un cliente..." id="IdClientUser" name="IdClientUser" class="chosen-select">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Fraccionamiento: </label>
                                    <input name='Suburb' id='Suburb' type='text' class='form-control'>
                                </div>
                                <div class="form-group">
                                    <label>Prioridad: <span class='text-danger'>(*)</span></label>
                                    <select class="form-control" id="IdPriority" name="IdPriority">
                                        @foreach($priorities as $priority)
                                            <option value="{{ $priority['Id'] }}">{{ $priority['Description'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Programar entrega a domicilio: <span class='text-danger'>(*)</span></label>
                                    <select class="form-control" id="ProgramDelivery" name="ProgramDelivery">
                                        <option value="0" selected>No</option>
                                        <option value="1" >Si</option>
                                    </select>
                                </div>
                                <input type='hidden' id='recommended_day' name='recommended_day' value="0">
                                <div id="divDeliveryDate">
                                </div>
                                <div class="form-group">
                                    <label>Fecha de entrega: <span class='text-danger'>(*)</span></label>
                                    <input class="form-control" type="date" id="DeliveryDate" name="DeliveryDate" value="">
                                </div>
                                <div class="form-group">
                                    <label>Hora de Entrega: <span class='text-danger'>(*)</span></label>
                                    <input class="form-control" type="time" id="DeliveryTime" name="DeliveryTime" value="17:30">
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
                                <a href="javascript:void(0)" class="text-danger" onclick="cancelFormNewClient()"><i class="fa fa-times"></i> Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveOrder()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class='modal inmodal' id='modalRegisterPayment' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalColor'>Registrar pago</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role='form' id='frmRegisterPayment' method='POST' autocomplete="off">
                                {{ csrf_field() }}
                                <input type='hidden' id='IdOrderPayment' name='IdOrderPayment' value="0">
                                <div class="form-group">
                                    <label>Efectivo:</label>
                                    <input class="form-control" type="number" id="efectivo" name="efectivo" value="0">
                                </div>
                                <div class="form-group">
                                    <label>Tarjeta:</label>
                                    <input class="form-control" type="number" id="tarjeta" name="tarjeta" value="0">
                                </div>
                                <div class="form-group">
                                    <label>Monedero:</label>
                                    <input class="form-control" type="number" id="monedero" name="monedero" value="0">
                                </div>
                                <div class="form-group">
                                    <label>Transferencia electrónica:</label>
                                    <input class="form-control" type="number" id="transferencia" name="transferencia" value="0">
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6"><h3>Total</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-info" id="totalAmount">100.00</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6"><h3>Pagado</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-info" id="totalPaid">100.00</h3>
                                </div>
                            </div>
                            <div class="hr-line-solid"></div>
                            <div class="row">
                                <div class="col-lg-6"><h3>Restante</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-danger" id="totalRemaining">100.00</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Calcular cambio</h2>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Pagar con:</label>
                                <input class="form-control" type="number" id="cantidad" name="cantidad" value="0">
                            </div>
                        </div>
                        <div class="col-lg-4" align="center">
                            <p>Total a pagar</p>
                            <h2 id="totalPagar"></h2>
                        </div>
                        <div class="col-lg-4" align="center">
                                <p>Cambio</p>
                                <h2 id="totalCambio" class="text-success"></h2>
                            </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveOrderPayment()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
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
                        <input type='hidden' id='IdOrderDelivery' name='IdOrderDelivery' value="0">
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
                            <input class="form-control" type="date" id="DateDelivery" name="DateDelivery">
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


    <!-- MODAL CHANGE CLIENT -->
    <div class='modal inmodal' id='modalChangeClient' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalChangeClient'>Cambiar cliente</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmChangeClient' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='IdOrderChangeClient' name='IdOrderChangeClient' value="0">
                        <div class="form-group">
                            <label>Cliente: <span class='text-danger'>(*)</span></label>
                            <select data-placeholder="Selecciona un cliente..." id="IdNewClient" name="IdNewClient" class="chosen-select">
                            </select>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveNewClient()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class='row' id="detailOrder"></div>

    <script>
        @if(Auth::user()->id_branch_office != null)
            filterBranchOffice = parseInt('{{ Auth::user()->id_branch_office }}');
        @endif

        orderSelected = 0;
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            //loadTableColors();
            $("#divClientData").hide();
            $("#detailOrder").empty();
            loadClients();

            var mem = $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $("#IdClientUser").change(function(){
                if(parseInt($("#IdClientUser").find(":selected").val()) == 9999 ){
                    $("#divClientData").show();
                }else{
                    $("#divClientData").hide();
                }
            });

            $("#efectivo").change(function(){
                $("#totalPagar").html("$ " + $("#efectivo").val());

                cantidad = parseFloat($("#cantidad").val());
                efectivo = parseFloat($("#efectivo").val());

                cambio = cantidad - efectivo;

                $("#totalCambio").html("$ " +cambio);
            });

            $("#cantidad").change(function(){
                cantidad = parseFloat($("#cantidad").val());
                efectivo = parseFloat($("#efectivo").val());

                cambio = cantidad - efectivo;

                $("#totalCambio").html("$ " +cambio);
            });

            @if(Auth::user()->id_branch_office != null)
                searchOrders();
            @endif

            $("#IdPriority").change(function(){
                requestDeliveryDate()
            });


            $('#orderCode').keypress(function (e) {
                if (e.which == 13) {
                    e.preventDefault();
                    code = $('#orderCode').val();
                    loadDetailOrder(code, null);
                    $('#modalSearchOrder').modal('hide');
                    $("#orderCode").val("");
                }
            });

        });

        function backToMain(){
            $('#divPaymentOrder').empty();
            $('#divTableDetail').empty();
            $('#detailOrder').empty();
            $("#mainDiv").show();
        }

        function loadClients(){
            $.ajax({
                type: "POST",
                url: "{{ route('orders.loadClients') }}",
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                },
                success : function(data) {
                    $("#IdClientUser").empty();
                    $("#IdNewClient").empty();
                    $("#IdClientUser").append('<option value="0">Seleccione...</option>');
                    $( data).each(function( index, item ) {
                        $("#IdClientUser").append('<option value="'+ item.Id+'">'+item.Name+' || '+item.Address+'</option>');
                        $("#IdNewClient").append('<option value="'+ item.Id+'">'+item.Name+' || '+item.Address+'</option>');
                    });
                    $("#IdClientUser").append('<option value="9999">Nuevo</option>');
                    $('.chosen-select').trigger('chosen:updated');
                }
            });
        }

        function requestDeliveryDate(){
            IdPriority = $("#IdPriority").find(":selected").val();
            $.ajax({
                type: "POST",
                url: "{{ route('orders.requestDeliveryDate') }}",
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    IdPriority: IdPriority
                },
                dataType: 'json',
                success : function(data) {
                    $("#divDeliveryDate").empty();
                    $("#divDeliveryDate").html('<p>Fecha de entrega</p><h3 class="text-info">'+data.nameDay+'</h3>');
                    $("#recommended_day").val(data.deliveryDate);
                    $("#DeliveryDate").val(data.deliveryDate);
                }
            });
        }

        function requestRemaining(cve){
            total = 0;
            amountPaid = 0;
            remaining = 0;
            $.ajax({
                type: "POST",
                url: "{{ route('orders.requestRemaining') }}",
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    cve: cve
                },
                dataType: 'json',
                success : function(data) {
                    total = data.total;
                    amountPaid = data.amountPaid;
                    remaining = data.remaining;

                }
            });
            return [total, amountPaid, remaining];
        }

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

        @if(Auth::user()->id_branch_office == null)
        function searchOrders(){
            $('#divTableOrders').load("{{ route('orders.searchOrders') }}",
                {
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                    filterStatus: $("#filterStatus").find(":selected").val(),
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val()
                });
            requestIndicators();
        }

        function requestIndicators(){
            $.ajax({
                type: "POST",
                url: "{{ route('orders.requestIndicators') }}",
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                    filterStatus: $("#filterStatus").find(":selected").val(),
                },
                dataType: 'json',
                success : function(data) {
                    $("#RecivedTodayNormal").html(data.ordersRecivedToday.RecivedTodayNormal);
                    $("#RecivedTodayUrgen").html(data.ordersRecivedToday.RecivedTodayUrgen);
                    $("#RecivedTodayExtra").html(data.ordersRecivedToday.RecivedTodayExtra);

                    $("#BackorderNormal").html(data.backorders.BackorderNormal);
                    $("#BackorderUrgen").html(data.backorders.BackorderUrgen);
                    $("#BackorderExtra").html(data.backorders.BackorderExtra);

                    $("#DeliveredTodayNormal").html(data.ordersDeliveredToday.DeliveredTodayNormal);
                    $("#DeliveredTodayUrgen").html(data.ordersDeliveredToday.DeliveredTodayUrgen);
                    $("#DeliveredTodayExtra").html(data.ordersDeliveredToday.DeliveredTodayExtra);

                    $("#LongTimeNormal").html(data.ordersLongTime.LongTimeNormal);
                    $("#LongTimeUrgen").html(data.ordersLongTime.LongTimeUrgen);
                    $("#LongTimeExtra").html(data.ordersLongTime.LongTimeExtra);

                }
            });
        }
        @else
        function searchOrders(){
            $('#divTableOrders').load("{{ route('orders.searchOrders') }}",
                {
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: filterBranchOffice,
                    filterStatus: $("#filterStatus").find(":selected").val(),
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val()
                });
            requestIndicators();
        }

        function requestIndicators(){
            $.ajax({
                type: "POST",
                url: "{{ route('orders.requestIndicators') }}",
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: filterBranchOffice,
                    filterStatus: $("#filterStatus").find(":selected").val(),
                },
                dataType: 'json',
                success : function(data) {
                    $("#RecivedTodayNormal").html(data.ordersRecivedToday.RecivedTodayNormal);
                    $("#RecivedTodayUrgen").html(data.ordersRecivedToday.RecivedTodayUrgen);
                    $("#RecivedTodayExtra").html(data.ordersRecivedToday.RecivedTodayExtra);

                    $("#BackorderNormal").html(data.backorders.BackorderNormal);
                    $("#BackorderUrgen").html(data.backorders.BackorderUrgen);
                    $("#BackorderExtra").html(data.backorders.BackorderExtra);

                    $("#DeliveredTodayNormal").html(data.ordersDeliveredToday.DeliveredTodayNormal);
                    $("#DeliveredTodayUrgen").html(data.ordersDeliveredToday.DeliveredTodayUrgen);
                    $("#DeliveredTodayExtra").html(data.ordersDeliveredToday.DeliveredTodayExtra);

                    $("#LongTimeNormal").html(data.ordersLongTime.LongTimeNormal);
                    $("#LongTimeUrgen").html(data.ordersLongTime.LongTimeUrgen);
                    $("#LongTimeExtra").html(data.ordersLongTime.LongTimeExtra);
                }
            });
        }
        @endif


        function loadDetailOrder(cve,e){
            orderSelected = cve;
            $(e).blur();
            $('#detailOrder').load("{{ route('orders.loadDetailOrder') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                },function(){
                    $("#mainDiv").hide();
                });
        }

        function openModalSearchOrder(){
            $("#orderCode").focus();
            $('#modalSearchOrder').modal('show');            
        }


        function newOrder(e){
            $(e).blur();
            $('#titleModalOrder').html('Nueva orden');
            resetForm('frmOrder');
            $('.chosen-select').trigger('chosen:updated');
            $('#Id').val(0);
            $('#modalOrder').modal('show');
            requestDeliveryDate()
        }

        function editOrder(cve,e){
            $(e).blur();
            resetForm('frmOrder');
            $('#titleModalOrder').html('Editar orden');
            $.post("{{ route('orders.edit') }}",
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmOrder').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalOrder').modal('show');
            });
        }

        function saveOrder(){
            @if(Auth::user()->id_branch_office != null)
                $("#IdBranchOffice").val(filterBranchOffice);
            @endif

            $('#frmOrder').form('submit', {
                url: "{{ route('orders.save') }}",
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmOrder');
                        //loadTableColors();
                        $('#modalOrder').modal('hide');

                        if(result.newClientRegister){
                            swal(
                                {
                                    title: 'Datos del cliente',
                                    text: 'Usuario: '+result.email+', Contraseña: '+result.pass,
                                    type: 'info',
                                    showCancelButton: false,
                                    closeOnConfirm: true,
                                    showLoaderOnConfirm: false,
                                    confirmButtonText: 'Correcto',
                                    cancelButtonText: 'No'

                                }, function(){
                                    loadDetailOrder(result.IdOrder,null);
                                    loadClients();
                                    $("#divClientData").hide();
                                });
                        }else{
                            loadDetailOrder(result.IdOrder,null);
                        }


                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function saveOrderPayment(){
            $('#frmRegisterPayment').form('submit', {
                url: "{{ route('orders.saveOrderPayment') }}",
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmRegisterPayment');
                        //loadTableColors();
                        if( orderSelected != 0){
                            loadDetailOrder(orderSelected,null);
                        }else{
                            searchOrders();
                        }
                        $('#modalRegisterPayment').modal('hide');
                        searchOrders();
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function registerPayment(cve,e){
            $(e).blur();

            amount = requestRemaining(cve);
            total = amount[0];
            paid = amount[1];
            remaining = amount[2];
            $("#totalAmount").html(total);
            $("#totalPaid").html(paid);
            $("#totalRemaining").html(remaining);
            resetForm('frmRegisterPayment');
            $('#IdOrderPayment').val(cve);
            $('#modalRegisterPayment').modal('show');
        }

        function programDelivery(cve,e){
            $(e).blur();
            resetForm('frmRegisterDelivery');
            $('#IdOrderDelivery').val(cve);
            $('#modalRegisterDelivery').modal('show');
        }

        function saveRegisterDelivery(){
            console.log('saveRegisterDelivery');
            $('#frmRegisterDelivery').form('submit', {
                url: "{{ route('orders.saveRegisterDelivery') }}",
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmRegisterDelivery');
                        $('#modalRegisterDelivery').modal('hide');
                        loadDetailOrder(orderSelected, null);
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }
        
        function changeClientOrder(cve, e){
            loadClients();
            $(e).blur();
            resetForm('frmChangeClient');
            $('.chosen-select').trigger('chosen:updated');
            $('#IdOrderChangeClient').val(cve);
            $('#modalChangeClient').modal('show');
        }

        function saveNewClient(){
            $('#frmChangeClient').form('submit', {
                url: "{{ route('orders.saveNewClient') }}",
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        $("#IdOrderPurse").val(0);
                        $('#modalChangeClient').modal('hide');
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmChangeClient');
                        loadDetailOrder(orderSelected,null);
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

    </script>

@endsection