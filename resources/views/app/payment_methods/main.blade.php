@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Métodos de pago</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newPaymentMethod(this)'>
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTablePaymentMethods'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ARTICLE -->
    <div class='modal inmodal' id='modalPaymentMethod' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalPaymentMethod'>Nuevo método de pago</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmPaymentMethod' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Descripción: <span class='text-danger'>(*)</span></label>
                            <input name='Description' id='Description' type='text' class='form-control'>
                        </div>
                    </form>
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
            loadTablePaymentMethods();
        });


        function loadTablePaymentMethods(){
            $('#divTablePaymentMethods').load('{{ route('payment_methods.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newPaymentMethod(e){
            $(e).blur();
            $('#titleModalDefect').html('Nuevo método de pago');
            resetForm('frmPaymentMethod');
            $('#Id').val(0);
            $('#modalPaymentMethod').modal('show');
        }

        function editPaymentMethod(cve,e){
            $(e).blur();
            resetForm('frmDefect');
            $('#titleModalPaymentMethod').html('Editar método de pago');
            $.post('{{ route('payment_methods.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmPaymentMethod').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalPaymentMethod').modal('show');
            });
        }

        function savePaymentMethod(){
            $('#frmPaymentMethod').form('submit', {
                url: '{{ route('payment_methods.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmPaymentMethod');
                        loadTablePaymentMethods();
                        $('#modalPaymentMethod').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deletePaymentMethod(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar método de pago?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('payment_methods.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTablePaymentMethods();
                        },'json');
                });
        }

    </script>

@endsection