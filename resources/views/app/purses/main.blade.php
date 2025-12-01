@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Monederos electronicos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='registerElectronicPurse(this)'>
                                <i class='fa fa-credit-card'></i> Registrar monedero
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTablePurses'></div>
                    </div>
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
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Cliente: <span class='text-danger'>(*)</span></label>
                            <select data-placeholder="Selecciona un cliente..." id="IdClientUser" name="IdClientUser" class="chosen-select">
                                <option value="0">Seleccione...</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client['Id'] }}">{{ $client['Name']." || ".$client['Address'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Escanea el código del monedero electrónico: <span class='text-danger'>(*)</span></label>
                            <input name='CodePurse' id='CodePurse' type='text' class='form-control'>
                        </div>
                        @if(Auth::user()->id_type_user < 3)
                        <div class="form-group">
                            <label>Monto inicial: <span class='text-danger'>(*)</span></label>
                            <input name='Amount' id='Amount' type='text' class='form-control'>
                        </div>
                        @endif
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

    <!-- MODAL ADD AMOUNT TO PURSE -->
    <div class='modal inmodal' id='modalAddAmountToPurse' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title'>Agregar monto al monedero</h4>
                </div>
                <div class="modal-body">
                    <form role='form' id='frmAddAmountToPurse' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='IdPurse' name='IdPurse' value="0">                        
                        <div class="form-group">
                            <label>Motivo: <span class='text-danger'>(*)</span></label>
                            <input name='Concept' id='Concept' type='text' class='form-control'>
                        </div>                        
                        <div class="form-group">
                            <label>Monto : <span class='text-danger'>(*)</span></label>
                            <input name='AmountToAdd' id='AmountToAdd' type='text' class='form-control'>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveAmountToPurse()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class='modal inmodal' id='modalPurseHistory' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                        <h4 class='modal-title' id='titleModalColor'>Historial del monedero</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="tablePurseHistory"></div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-white' data-dismiss='modal'>
                            <i class='fa fa-times'></i> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>


    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTablePurses();
        });


        function loadTablePurses(){
            $('#divTablePurses').load('{{ route('purses.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function registerElectronicPurse(){
            resetForm('frmPurse');
            $('#Id').val(0);
            $('.chosen-select').trigger('chosen:updated');
            $('#modalPurse').modal('show');
            $('#titleModalPurse').html('Registrar monedero');
        }

        function editPurse(cve,e){
            $(e).blur();
            resetForm('frmPurse');
            $('#titleModalPurse').html('Editar monedero');
            $.post('{{ route('purses.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmPurse').form('load', result.data);
                    $('.chosen-select').trigger('chosen:updated');
                }, 'json').always(function (result) {
                $('#modalPurse').modal('show');
            });
        }

        function addAmountToPurse(cve,e){
            $(e).blur();
            resetForm('frmAddAmountToPurse');
            $('#modalAddAmountToPurse').modal('show');
            $('#IdPurse').val(cve);
            
        }

        function showPurseHistory(cve, e){
            $(e).blur();
            $('#tablePurseHistory').load('{{ route('purses.showPurseHistory') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                },function(){
                    $('#modalPurseHistory').modal('show');
                });
        }

        function savePurse(){
            $('#frmPurse').form('submit', {
                url: '{{ route('purses.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmPurse');
                        $('#modalPurse').modal('hide');
                        loadTablePurses();
                        $('.chosen-select').trigger('chosen:updated');
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function saveAmountToPurse(){
            $('#frmAddAmountToPurse').form('submit', {
                url: "{{ route('purses.add_amount') }}",
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmAddAmountToPurse');
                        $('#modalAddAmountToPurse').modal('hide');
                        loadTablePurses();
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }


        function deletePurse(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar monedero?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('purses.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTablePurses();
                        },'json');
                });
        }

    </script>

@endsection