<div class='col-lg-3'>
    <div class='ibox float-e-margins'>
        <div class='ibox-title'>
            <h5>Detalle de la orden</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <button type='button' class='btn btn-outline btn-white btn-block' onclick='backToMain(this)'>
                        <i class="fa fa-arrow-left"></i> Regresar
                    </button>
                    @if($order['IdOrderStatus'] > 1 && $order['IdOrderStatus'] < 6 && (Auth::user()->id_user_type <= 3 || Auth::user()->id_user_type == 12) )
                    <button type='button' class='btn btn-outline btn-white btn-block'
                            onclick='registerPayment({{ $order['Id'] }},this)'>
                        <i class="fa fa-money"></i> Pagar
                    </button>
                    @endif
                    @if($order['IdOrderStatus'] > 1 && $order['IdOrderStatus'] < 6)
                    <button type='button' class='btn btn-outline btn-white btn-block'
                            onclick='printOrder({{ $order['Id'] }},this)'>
                        <i class="fa fa-print"></i> Imprimir nota
                    </button>
                    @endif
                    <button type='button' class='btn btn-outline btn-white btn-block'
                            onclick="programDelivery({{ $order['Id'] }},this)">
                        <i class="fa fa-calendar"></i> Registrar entrega
                    </button>
                </div>
                <div class="col-lg-12">
                    <h3>
                        <small class="text-info"><strong>Folio:</strong></small>
                        <br>
                        {{ $order['Series'].'-'.$order['Folio'] }}
                    </h3>
                    <div style="background-color: {{ $order['Color'] }}; padding: 5px; color: #ffffff">
                        <h3 align="center">
                            <strong>{{ $order['OrderStatus'] }}</strong>
                        </h3>
                    </div>
                    <h3>
                        <small class="text-info"><strong>Cliente:</strong></small><br>
                        {{ $order['NameClient'] }}
                    </h3>
                    @if($order['IdOrderStatus'] < 6)
                    <button type='button' class="btn btn-white btn-xs" onclick="changeClientOrder({{ $order['Id'] }},this)">
                        <i class="fa fa-edit"></i>  Cambiar cliente
                    </button>
                    @endif
                    <h3>
                        <small class="text-info"><strong>Prioridad:</strong></small><br>
                        {{ $order['DescriptionPriority'] }}
                    </h3>
                    <p >
                        <small class="text-info"><strong>Observaciones:</strong></small><br>
                    </p>
                    <p id="textObservations">
                        {{ $order['Observations'] }}
                    </p>
                    <div id="optionsObservations" align="right">
                        <button class="btn btn-white btn-xs" onclick="editObservations()">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                    </div>
                    <div id="inputObservationsOrder">
                        <textarea name="ObservationsOrder" id="ObservationsOrder" cols="30" rows="5">
                                {{ $order['Observations'] }}
                        </textarea>
                        <div class="btn-group float-right">
                            <button class="btn btn-danger btn-xs" onclick="cancelEditObservations()">
                                <i class="fa fa-times"></i> Cancelar
                            </button>
                            <button class="btn btn-white btn-xs" onclick="saveObservations({{ $order['Id'] }},this)">
                                <i class="fa fa-check"></i> Guardar
                            </button>
                        </div>
                    </div>
                    <h3>
                        <small class="text-info"><strong>Recepción:</strong></small><br>
                        {{ $order['ReceptionDate'] }}<br>{{ $order['ReceptionTime'] }}
                    </h3>
                    <div class="hr-line-solid"></div>
                    <div class="row">
                        <div class="col-lg-6"><h3>Total</h3></div>
                        <div class="col-lg-6" align="right">
                            <h3 class="text-info" >{{ $order['Total'] }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><h3>Pagado</h3></div>
                        <div class="col-lg-6" align="right">
                            <h3 class="text-info" >{{ $order['AmountPaid'] }}</h3>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-6"><h3>Restante</h3></div>
                        <div class="col-lg-6" align="right">
                            <h3 class="text-danger">{{ $order['Total'] - $order['AmountPaid'] }}</h3>
                        </div>
                    </div>
                    <div class="hr-line-solid"></div>
                    <h3>
                        <small class="text-info"><strong>Entrega estimada:</strong></small><br>
                        {{ $order['DeliveryDate'] }}<br>{{ $order['DeliveryTime'] }}
                    </h3>
                    @if($order['IdOrderStatus'] == 6)
                    <h3>
                        <small class="text-info"><strong>Entrega real:</strong></small><br>
                        {{ $order['RealDeliveryDate'] }}<br>{{ $order['RealDeliveryTime'] }}
                    </h3>
                    <h3>
                        <small class="text-info"><strong>Entregada por:</strong></small><br>
                        {{ $order['NameDaliveryUser'] }}
                    </h3>
                    @endif
                    @if($order['Qualified'] == 1)
                    <div class="hr-line-solid"></div>
                    <h3>
                        <small class="text-info"><strong>Calificación:</strong></small><br>
                        {{ $order['Rank'] }}
                    </h3>
                    <h3>
                        <small class="text-info"><strong>Comentarios:</strong></small><br>
                        {{ $order['ClientComments'] }}
                    </h3>
                    @endif
                    @if($order['IdOrderStatus'] == 1)
                        <button type='button' class='btn btn-primary btn-block' onclick='markAsPending()'>
                            <i class='fa fa-check'></i> Cerrar registro
                        </button>
                    @endif
                    @if($order['IdOrderStatus'] == 5)
                        <button type='button' class='btn btn-primary btn-block' onclick='markAsDelivered()'>
                            <i class='fa fa-check'></i> Marcar como entregada
                        </button>
                    @endif
                    @if( $order['IdOrderStatus'] < 5 )
                        <button type='button' class='btn btn-danger btn-block' onclick='cancelOrder()'>
                            <i class='fa fa-times'></i> Cancelar orden
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class='ibox float-e-margins'>
        <div class='ibox-title'>
            <h5>Monedero electrónico</h5>
        </div>
        <div class="ibox-content" align="center">
            @if($havePurse == 0)
                <h3 class="text-danger">
                    Sin monedero electronico
                </h3>
                <button type='button' class='btn btn-primary btn-block' onclick='registerElectronicPurse()'>
                    <i class='fa fa-credit-card'></i> Registrar monedero
                </button>
            @else
                <h3>
                    {{ $purse['Code'] }}
                </h3>
                <h1 class="text-success">
                    $ {{ $purse['Amount'] }}
                </h1>
            @endif
        </div>
    </div>
</div>

@if($order['IdOrderStatus'] == 1)
    <div class='col-lg-9'>
        <div class='ibox float-e-margins'>
            <div class='ibox-title'>
                <h5>Agregar pieza</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form role='form' id='frmDetailOrder' method='POST' autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-3">
                            <input type='hidden' id='IdAssignedOrder' name='IdAssignedOrder' value="{{ $order['Id'] }}">
                            <input type='hidden' id='IdDetailOrder' name='IdDetailOrder' value="0">
                            <input type='hidden' id='IdPriorityOrder' name='IdPriorityOrder' value="{{ $order['IdPriority'] }}">
                            <div class="form-group" >
                                <label>Categoría:</label>
                                <select name="IdServiceCategory" id="IdServiceCategory" class="chosen-select">
                                    <option value="0">Seleccione...</option>
                                    @foreach($serviceCategories as $serviceCategory)
                                        <option value="{{ $serviceCategory['Id'] }}">{{ $serviceCategory['Description'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" >
                                <label>Servicio:</label>
                                <select name="IdService" id="IdService" class="chosen-select">
                                    <option value="0">Seleccione...</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="form-group" >
                                <label>Precio:</label>
                                <input type="number" id="Price" data-minprice="0" name="Price" class="form-control">
                            </div>
                            <div class="form-group" >
                                <label>Cantidad:</label>
                                <input type="number" id="Quantity" name="Quantity" value="1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-8">
                                <div class="form-group" >
                                    <label>Descuento:</label>
                                    <input type="number" id="Discount" name="Discount" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group" >
                                    <label>Tipo:</label>
                                    <select name="IdTypeDiscount" id="IdTypeDiscount" class="form-control">
                                        <option value="1">%</option>
                                        <option value="2">$</option>
                                    </select>
                                </div>
                            </div>
                            <!--
                            <div class="col-lg-12">
                                <div class="form-group" >
                                    <label>Observaciones:</label>
                                    <input type="text" id="Observations" name="Observations" class="form-control">
                                </div>
                            </div>
                            -->
                        </div>
                    </div>

                    <div class="hr-line-solid"></div>

                    <div class="row" id="characteristics">
                        <div class="col-lg-12"></div>
                        <div class="col-lg-12 inputsCharacteristics" id="originalInputsCharacteristics">
                            <div class="row" id="O">
                                <div class="col-lg-2 col-sm-2" align="center">
                                    <h3 class="text-info itemNumber">1</h3>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="form-group" >
                                        <label>Color: <i class="fa fa-circle fa-2x iconColor" id="iconColor"></i></label>
                                        <select name="IdColor1" id="IdColor1" data-color="iconColor" class="itemColor form-control">
                                            <option value="1" data-code="#000000">Varios</option>
                                            @foreach($colors as $color)
                                                <option data-code="{{ $color['Code'] }}" value="{{ $color['Id'] }}">
                                                    {{ $color['Description'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="form-group" >
                                        <label>Estampado:</label>
                                        <select name="IdPrint1" id="IdPrint1" class="itemPrint form-control">
                                            <option value="1">Ninguno</option>
                                            @foreach($prints as $print)
                                                <option value="{{ $print['Id'] }}">{{ $print['Description'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="form-group" >
                                        <label>Defecto:</label>
                                        <select name="IdDefect1" id="IdDefect1" class="itemDefect form-control">
                                            <option value="1">Ninguno</option>
                                            @foreach($defects as $defect)
                                                <option value="{{ $defect['Id'] }}">{{ $defect['Description'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group" >
                                        <label>Observaciones:</label>
                                        <input type="text" id="Observations1" name="Observations1" class="itemObservations form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hr-line-dashed"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-solid"></div>

                    @if($order['IdOrderStatus'] < 5)
                        <div class="row">
                            <button type='button' class='btn btn-white' onclick='clarFormDetail()'>
                                <i class='fa fa-times'></i> Cancelar
                            </button>
                            <button type='button' class='btn btn-primary' onclick='saveDetailOrder()'>
                                <i class='fa fa-check'></i> Guardar
                            </button>
                        </div>
                    @endif


                </form>
            </div>
        </div>
    </div>
@endif



@if($order['IdOrderStatus'] > 1)
    <div class='col-lg-9'>
        <div class='ibox float-e-margins'>
            <div class='ibox-title'>
                <h5>Pagos realizados</h5>
            </div>
            <div class="ibox-content">
                <div class="row" id="divPaymentOrder"></div>
            </div>
        </div>
    </div>
@endif

<div class='col-lg-9'>
    <div class='ibox float-e-margins'>
        <div class='ibox-title'>
            <h5>Entregas programadas</h5>
        </div>
        <div class="ibox-content">
            <div class="row" id="divDeliveries">
                <div class="col-lg-12">
                    <div class='table-responsive' >
                        <table id='dataTableDeliveries' class='table table-striped table-bordered table-hover'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Repartidor</th>
                                    <th>Comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $n = 1; ?>
                            @foreach($deliveries as $delivery)
                                <tr>
                                    <td>{{ $n }}</td>
                                    <td>
                                        <button type='button' class='btn btn-outline btn-white btn-sm'
                                                onclick="reprogramDelivery({{ $delivery['Id'] }},this)">
                                            <i class="fa fa-calendar"></i> Reprogramar
                                        </button>
                                    </td>
                                    <td>{{ $delivery['DayDelivery'] }}</td>
                                    <td>{{ $delivery['TimeDelivery'] }}</td>
                                    <td>{{ $delivery['AssignedName'] }}</td>
                                    <td>{{ $delivery['Comments'] }}</td>
                                    <?php $n++; ?>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="{{ $order['IdOrderStatus'] == 1 ? 'col-lg-12' : 'col-lg-9'}}">
    <div class='ibox float-e-margins'>
        <div class='ibox-title'>
            <h5>Piezas</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                @if($order['IdOrderStatus'] > 1 && $order['IdOrderStatus'] < 6 )
                <div class="col-lg-12" align="right">
                    <button type='button' class='btn btn-outline btn-white' onclick='masiveChangeStatus(this)'>
                        <i class="fa fa-dot-circle-o"></i> Actualizar estatus
                    </button>
                </div>
                @endif
                <div class="col-lg-12" id="divTableDetail" style="padding-bottom: 50px"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal reprogram delivery -->
<div class='modal inmodal' id='modalReprogramDelivery' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalReprogramDelivery'>Reprogramar entrega</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmReprogramDelivery' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='IdDelivery' name='IdDelivery' value="0">                        
                        <div class="form-group">
                            <label>Fecha: <span class='text-danger'>(*)</span></label>
                            <input class="form-control" type="date" id="NewDateDelivery" name="NewDateDelivery">
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveReprogramDelivery()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


<!-- MODAL CHANGE DETAIL STATUS -->
<div class='modal inmodal' id='modalChangeDetailStatus' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class='modal-title' id='titleModalColor'>Cambiar estatus</h4>
            </div>
            <div class="modal-body">
                <div>
                    <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                </div>

                <form role='form' id='frmChangeDetailStatus' method='POST' autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type='hidden' id='IdDetailToUpdate' name='IdDetailToUpdate' value="0">
                    <div class="form-group">
                        <label>Descripción: <span class='text-danger'>(*)</span></label>
                        <select name='IdOrderDetailStatus' id='IdOrderDetailStatus' class='form-control'>
                            <option value="0">Selecciona...</option>
                            @foreach($status as $stat)
                                <option value="{{ $stat['Id'] }}">{{ $stat['Description'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Descripción: <span class='text-danger'>(*)</span></label>
                        <input name='DescriptionStatus' id='DescriptionStatus' type='text' class='form-control'>
                    </div>
                    <div class="form-group" id="inputLocation">
                        <label>Ubicación: <span class='text-danger'>(*)</span></label>
                        <input name='Location' id='Location' type='text' class='form-control'>
                    </div>
                    <div class="form-group" id="inputImage">
                        <label>Imágen: <span class='text-danger'>(*)</span></label>
                        <input name="imageStatus" id='imageStatus' type='file' class='form-control'>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-white' data-dismiss='modal'>
                    <i class='fa fa-times'></i> Cerrar
                </button>
                <button type='button' class='btn btn-primary' onclick='saveDetailStatus()'>
                    <i class='fa fa-check'></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CHANGE DETAIL STATUS -->
<div class='modal inmodal' id='modalMasiveChangeStatus' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class='modal-title' id='titleModalColor'>Cambiar estatus</h4>
            </div>
            <div class="modal-body">
                <div>
                    <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                </div>

                <form role='form' id='frmMasiveChangeStatus' method='POST' autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Descripción: <span class='text-danger'>(*)</span></label>
                        <select name='IdStatusDetails' id='IdStatusDetails' class='form-control'>
                            <option value="0">Selecciona...</option>
                            @foreach($status as $stat)
                                <option value="{{ $stat['Id'] }}">{{ $stat['Description'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Descripción: <span class='text-danger'>(*)</span></label>
                        <input name='DescriptionStatusMasive' id='DescriptionStatusMasive' type='text' class='form-control'>
                    </div>
                    <div class="form-group" id="inputLocationMasive">
                        <label>Ubicación: <span class='text-danger'>(*)</span></label>
                        <input name='LocationMasive' id='LocationMasive' type='text' class='form-control'>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-white' data-dismiss='modal'>
                    <i class='fa fa-times'></i> Cerrar
                </button>
                <button type='button' class='btn btn-primary' onclick='saveStatusMasive()'>
                    <i class='fa fa-check'></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<div class='modal inmodal' id='modalDetailHistory' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class='modal-title' id='titleModalColor'>Historial del elemento</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="tableDetailHistory"></div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-white' data-dismiss='modal'>
                    <i class='fa fa-times'></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PURSE -->
<div class='modal inmodal' id='modalPurse' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class='modal-title' id='titleModalPurse'>Registrar monedero electrónico</h4>
            </div>
            <div class="modal-body">
                <form role='form' id='frmPurse' method='POST' autocomplete="off">
                    {{ csrf_field() }}
                    <input type='hidden' id='IdOrderPurse' name='IdOrderPurse' value="0">
                    <div class="form-group">
                        <label>Escanea el código del monedero electrónico: <span class='text-danger'>(*)</span></label>
                        <input name='CodePurse' id='CodePurse' type='text' class='form-control'>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-white' data-dismiss='modal'>
                    <i class='fa fa-times'></i> Cerrar
                </button>
                <button type='button' class='btn btn-primary' onclick='savePurse()'>
                    <i class='fa fa-check'></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<div class='modal inmodal' id='modalChangePaymentMetod' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class='modal-title' id='titleModalChangePaymentMetod'>Cambiar método de pago</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role='form' id='frmChangePaymentMetod' method='POST' autocomplete="off">
                            {{ csrf_field() }}
                            <input type='hidden' id='IdPayment' name='IdPayment' value="0">
                            <div class="form-group">
                                <label>Forma de pago: <span class='text-danger'>(*)</span></label>
                                <select name='IdNewPaymentMethod' id='IdNewPaymentMethod' class='form-control'>
                                    @foreach($paymentMethods as $payment)
                                        <option value="{{ $payment['Id'] }}">{{ $payment['Description'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-white' data-dismiss='modal'>
                    <i class='fa fa-times'></i> Cerrar
                </button>
                <button type='button' class='btn btn-primary' onclick='savePaymentMethod()'>
                    <i class='fa fa-check'></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.chosen-select').chosen({width: "100%"});
        loadTableDetailOrder();
        loadTablePaymentsOrder();

        $("#inputObservationsOrder").hide();

        $("#inputLocationMasive").hide();
        $("#inputLocation").hide();
        $("#inputImage").hide();

        $("#IdServiceCategory").change(function(){
            loadServices();
        });

        $("#IdService").change(function(){
            cve = $("#IdService").find(":selected").val();
            if(cve == 10){
                $("#Quantity").val(1).prop('readonly', true);
            }else{
                $("#Quantity").prop('readonly', false);
            }
            printInputs();
            requestPrice();
        });

        $(".itemColor").change(function(){
            code = $(this).find(":selected").data('code');
            //console.log(code);
            //console.log($(this).data('color'));
            $("#"+$(this).data('color')).css('color',code);
        });

        $("#IdOrderDetailStatus").change(function(){
            cve = $("#IdOrderDetailStatus").find(":selected").val();
            if(cve == 4){
                $("#inputLocation").show();
                $("#inputImage").hide();
            }else if(cve == 3){
                $("#inputImage").show();
                $("#inputLocation").hide();
            }else{
                $("#inputLocation").hide();
                $("#inputImage").hide();
            }
        });
        
        $("#IdStatusDetails").change(function(){
            cve = $("#IdStatusDetails").find(":selected").val();
            if(cve == 4){
                $("#inputLocationMasive").show();
            }else{
                $("#inputLocationMasive").hide();
            }
        });

        $("#Quantity").change(function(){
            if($("#IdDetailOrder").val() == 0) {
                printInputs();
            }
        });
    });

    function editObservations(){
        $("#textObservations").hide();
        $("#optionsObservations").hide();
        $("#inputObservationsOrder").show();
    }
   
    function cancelEditObservations(){
        $("#textObservations").show();
        $("#optionsObservations").show();
        $("#inputObservationsOrder").hide();
    }

    function reprogramDelivery(cve,e){
        $(e).blur();
        resetForm('frmReprogramDelivery');
        $('#IdDelivery').val(cve);
        $('#modalReprogramDelivery').modal('show');
    }

    function saveReprogramDelivery(){
        console.log('saveRegisterDelivery');
        $('#frmReprogramDelivery').form('submit', {
            url: "{{ route('orders.saveReprogramDelivery') }}",
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if(result.success){
                    alertaSuccess('Correcto', result.errorMsg);
                    resetForm('frmReprogramDelivery');
                    $('#modalReprogramDelivery').modal('hide');
                    loadDetailOrder(orderSelected, null);
                }else{
                    alertaError('Error',result.errorMsg);
                }
            }
        });
    }

    function saveObservations(cve, e){
        obs = $("#ObservationsOrder").val();
        $.ajax({
            type: "POST",
            url: '{{ route('orders.saveObservations') }}',
            async: false,
            data:{
                _token: '{{ csrf_token() }}',
                cve: cve,
                obs: obs
            },
            dataType: 'json',
            success : function(result) {
                if(result.success){
                    $("#textObservations").html(obs).show();
                    $("#optionsObservations").show();
                    $("#inputObservationsOrder").hide();
                    alertaSuccess('Correcto', result.errorMsg);
                }else{
                    alertaError('Error',result.errorMsg);
                }
            }
        });
    }

    function printOrder() {
        window.open('{{ route('orders.printOrder',['cve' => $order['Id']])  }}',
            '_blank',
            'fullscreen=yes,directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no');
    }

    function printInputs(){
        Quantity = parseInt($("#Quantity").val());
        rows = $("#characteristics").find(".inputsCharacteristics").length + 1;
        if($("#IdService").find(":selected").val() == 1 || $("#IdService").find(":selected").val() == 5 || $("#IdService").find(":selected").val() == 10 || $("#IdService").find(":selected").val() == 628){
            for (i = rows; i > 1; i--) {
                $("#inputsCharacteristics" + i).remove();
            }
        }else{
            if (Quantity < rows) {
                for (i = rows; i > Quantity; i--) {
                    $("#inputsCharacteristics" + i).remove();
                }
            } else {
                for (i = rows; i <= Quantity; i++) {
                    newRow = $(".inputsCharacteristics").first().clone();
                    $(newRow).find(".itemNumber").html(i);
                    $(newRow).find(".iconColor").attr("id", "iconColor" + i);
                    $(newRow).find(".itemColor").attr("id", "IdColor" + i).attr("name", "IdColor" + i).data('color', "iconColor" + i);
                    $(newRow).find(".itemPrint").attr("id", "IdPrint" + i).attr("name", "IdPrint" + i);
                    $(newRow).find(".itemDefect").attr("id", "IdDefect" + i).attr("name", "IdDefect" + i);
                    $(newRow).find(".itemObservations").attr("id", "Observations" + i).attr("name", "Observations" + i);
                    //$(newRow).removeClass("inputsCharacteristics").addClass("inputsCharacteristics"+i);
                    $(newRow).attr("id", "inputsCharacteristics" + i);
                    //console.log(newRow);
                    //$(newRow).find('.chosen-select').chosen({width: "100%"});
                    $("#characteristics").append(newRow);
                    //console.log($("#characteristics").find(".inputsCharacteristics").length);
                }

                $(".itemColor").change(function(){
                    code = $(this).find(":selected").data('code');
                    //console.log(code);
                    //console.log($(this).data('color'));
                    $("#"+$(this).data('color')).css('color',code);
                });
            }
        }
    }

    function loadServices(){
        idCategory = $("#IdServiceCategory").find(":selected").val();
        $.ajax({
            type: "POST",
            url: '{{ route('orders.loadServices') }}',
            async: false,
            data:{
                _token: '{{ csrf_token() }}',
                idCategory: idCategory
            },
            success : function(data) {
                $("#IdService").empty();
                $("#IdService").append('<option value="0">Seleccione...</option>');
                $( data).each(function( index, item ) {
                    $("#IdService").append('<option value="'+ item.Id+'">'+item.Description+'</option>');
                });
                $('.chosen-select').trigger('chosen:updated');
            }
        });
    }

    function requestPrice(){
        IdPriorityOrder = $("#IdPriorityOrder").val();
        IdService = $("#IdService").find(":selected").val();

        $.ajax({
            type: "POST",
            url: '{{ route('orders.requestPrice') }}',
            async: false,
            data:{
                _token: '{{ csrf_token() }}',
                IdPriorityOrder: IdPriorityOrder,
                IdService: IdService
            },
            dataType: 'json',
            success : function(data) {
                //console.log(data);
                if(data.success){
                    $("#Price").val(data.price);
                    $("#Price").prop("min",data.price);
                    $("#Price").data("minprice",data.price);
                }else{
                    $("#Price").val(0);
                    $("#Price").prop("min",0);
                    $("#Price").data("minprice",0);
                }
            }
        });
    }

    function loadTableDetailOrder(){
        $('#divTableDetail').load("{{ route('orders.loadTableDetailOrder') }}",
            {
                _token: '{{ csrf_token() }}',
                cve: orderSelected
            });
        searchOrders();
    }

    function loadTablePaymentsOrder(){
        $('#divPaymentOrder').load("{{ route('orders.loadTablePaymentsOrder') }}",
            {
                _token: '{{ csrf_token() }}',
                cve: orderSelected
            });
    }

    function markAsPending(){
        $.post('{{ route('orders.markAsPending') }}',
            {
                _token:'{{ csrf_token() }}',
                cve:orderSelected

            },function (result) {
                alertaSuccess('Correcto', result.errorMsg);
                loadDetailOrder(orderSelected,null);
            },'json');

    }

    function markAsDelivered(){
        swal(
            {
                title: '¿Entregar orden?',
                text: '',
                type: 'info',
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: false,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'

            }, function(){
                $.post('{{ route('orders.markAsDelivered') }}',
                    {
                        _token:'{{ csrf_token() }}',
                        cve:orderSelected

                    },function (result) {
                        if(result.success){
                            loadDetailOrder(orderSelected,null);
                            swal({
                                title: 'Correcto',
                                text: result.errorMsg,
                                type: "success"
                            });
                        }else{
                            swal("Error", result.errorMsg, "error");
                        }
                    },'json');
            });
    }

    function cancelOrder(){
        swal(
            {
                title: '¿Cancelar orden?',
                text: '',
                type: 'info',
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: false,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'

            }, function(){
                $.post('{{ route('orders.cancelOrder')  }}',
                    {
                        _token:'{{ csrf_token() }}',
                        cve:orderSelected

                    },function (result) {
                        if(result.success){
                            backToMain(this);
                            searchOrders();
                            swal({
                                title: 'Orden cancelada',
                                text: result.errorMsg,
                                type: "success"
                            });
                        }else{
                            swal("Eliminar orden", result.errorMsg, "error");
                        }
                    },'json');
            });
    }

    function registerElectronicPurse(){
        resetForm('frmPurse');
        $("#IdOrderPurse").val(orderSelected);
        $('#modalPurse').modal('show');
    }

    function savePurse(){
        $('#frmPurse').form('submit', {
            url: '{{ route('orders.savePurse') }}',
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if(result.success){
                    $("#IdOrderPurse").val(0);
                    $('#modalPurse').modal('hide');
                    alertaSuccess('Correcto', result.errorMsg);
                    resetForm('frmPurse');
                    loadDetailOrder(orderSelected,null);
                }else{
                    alertaError('Error',result.errorMsg);
                }
            }
        });
    }

    function showDetailHistory(cve, e){
        $(e).blur();
        $('#tableDetailHistory').load('{{ route('orders.showDetailHistory') }}',
            {
                _token: '{{ csrf_token() }}',
                cve: cve
            },function(){
                $('#modalDetailHistory').modal('show');
            });
    }

    function clarFormDetail(){
        resetForm('frmDetailOrder');
        $('.chosen-select').trigger('chosen:updated');
        loadServices();
        $("#IdAssignedOrder").val(orderSelected);
        $("#IdDetailOrder").val(0);
    }

    function updateStatusDetail(cve,e){
        $(e).blur();
        resetForm('frmChangeDetailStatus');
        $('#IdDetailToUpdate').val(cve);
        $('#modalChangeDetailStatus').modal('show');
    }

    function editDetail(cve,e){
        $(e).blur();
        clarFormDetail();
        $.post('{{ route('orders.editDetail') }}',
            {
                _token: '{{ csrf_token() }}',
                cve: cve
            }, function (result) {
                //console.log(result.data);
                $('#frmDetailOrder').form('load', result.data);
                $('.chosen-select').trigger('chosen:updated');
                loadServices();
                $('#IdService').val(result.data.IdService);
                $('.chosen-select').trigger('chosen:updated');
            }, 'json');
    }

    function saveDetailOrder(){
        if(parseFloat($("#Price").val()) >= parseFloat($("#Price").data("minprice"))){
            $('#frmDetailOrder').form('submit', {
                url: '{{ route('orders.saveDetail') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmDetailOrder');
                        $('.chosen-select').trigger('chosen:updated');
                        loadDetailOrder(orderSelected,null);
                        searchOrders();

                        $("#Quantity").val(1).prop('readonly', false);

                        rows = $("#characteristics").find(".inputsCharacteristics").length + 1;
                        for (i = rows; i > 1; i--) {
                            $("#inputsCharacteristics" + i).remove();
                        }

                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }else{
            alertaError('Error','El precio para el servicio seleccionado no puede ser menor a '+$("#Price").data("minprice"));
        }
    }

    function saveDetailStatus(){
        $('#frmChangeDetailStatus').form('submit', {
            url: '{{ route('orders.saveDetailStatus') }}',
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if(result.success){
                    alertaSuccess('Correcto', result.errorMsg);
                    resetForm('frmChangeDetailStatus');
                    $('#modalChangeDetailStatus').modal('hide');
                    loadDetailOrder(orderSelected,null);
                    searchOrders();
                }else{
                    alertaError('Error',result.errorMsg);
                }
            }
        });
    }

    function masiveChangeStatus(e){
        $(e).blur();
        resetForm('frmMasiveChangeStatus');
        $('#modalMasiveChangeStatus').modal('show');
    }

    function saveStatusMasive(){
        ids = [];
            $.each($("#dataTableDetailOrder tr.selected"), function (key, element) {
                //console.log(element);
                ids.push(parseInt($(element).data('id')));
            });
        IdStatusDetails = $("#IdStatusDetails").find(":selected").val();
        if (ids.length > 0 && IdStatusDetails > 0) {
            DescriptionStatusMasive = $("#DescriptionStatusMasive").val();
            LocationMasive = $("#LocationMasive").val();
            $.ajax({
                type: "POST",
                url: '{{ route('orders.saveStatusMasive') }}',
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    orderSelected: orderSelected,
                    IdStatusDetails: IdStatusDetails,
                    DescriptionStatusMasive: DescriptionStatusMasive,
                    LocationMasive: LocationMasive,
                    ids: ids
                },
                dataType: 'json',
                success : function(data) {
                    if(data.success){
                        loadDetailOrder(orderSelected,null);
                        searchOrders();
                        $('#modalMasiveChangeStatus').modal('hide');
                        swal({
                            title: 'Correcto',
                            text: data.errorMsg,
                            type: "success"
                        });
                    }else{
                        swal("Error", data.errorMsg, "error");
                    }
                }
            });
        }else{
            swal("Error", "Selecciona un estatus valido y al menos un item ", "error");
        }
    }

    function deleteDetail(cve,e){
        $(e).blur();
        swal(
            {
                title: '¿Eliminar item?',
                text: '',
                type: 'info',
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: false,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'

            }, function(){
                $.post('{{ route('orders.deleteDetail') }}',
                    {
                        _token:'{{ csrf_token() }}',
                        cve:cve

                    },function (result) {
                        alertaSuccess('Correcto', result.errorMsg);
                        loadDetailOrder(orderSelected,null);
                        searchOrders();
                    },'json');
            });
    }


    function deletePayment(cve,e){
        $(e).blur();
        swal(
            {
                title: '¿Eliminar pago realizado?',
                text: '',
                type: 'info',
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: false,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'

            }, function(){
                $.post('{{ route('orders.deletePayment') }}',
                    {
                        _token:'{{ csrf_token() }}',
                        cve:cve

                    },function (result) {
                        alertaSuccess('Correcto', result.errorMsg);
                        loadTablePaymentsOrder();
                    },'json');
            });
    }

    function changePaymentMethod(cve, cvePM,e){
        $(e).blur();
        resetForm('frmChangePaymentMetod');
        $('#IdPayment').val(cve);
        $('#IdNewPaymentMethod').val(cvePM);
        $('#modalChangePaymentMetod').modal('show');
    }

    function savePaymentMethod(){
        $('#frmChangePaymentMetod').form('submit', {
            url: '{{ route('orders.savePaymentMethod') }}',
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if(result.success){
                    alertaSuccess('Correcto', result.errorMsg);
                    resetForm('frmChangePaymentMetod');
                    $('#modalChangePaymentMetod').modal('hide');
                    loadTablePaymentsOrder();
                }else{
                    alertaError('Error',result.errorMsg);
                }
            }
        });
    }

</script>