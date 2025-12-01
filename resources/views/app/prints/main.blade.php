@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Estampados</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newPrint(this)'>
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTablePrints'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ARTICLE -->
    <div class='modal inmodal' id='modalPrint' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalPrint'>Nuevo estampado</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmPrint' method='POST' autocomplete="off">
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
                    <button type='button' class='btn btn-primary' onclick='savePrint()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTablePrints();
        });


        function loadTablePrints(){
            $('#divTablePrints').load('{{ route('prints.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newPrint(e){
            $(e).blur();
            $('#titleModalArticle').html('Nuevo estampado');
            resetForm('frmPrint');
            $('#Id').val(0);
            $('#modalPrint').modal('show');
        }

        function editPrint(cve,e){
            $(e).blur();
            resetForm('frmPrint');
            $('#titleModalPrint').html('Editar estampado');
            $.post('{{ route('prints.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmPrint').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalPrint').modal('show');
            });
        }

        function savePrint(){
            $('#frmPrint').form('submit', {
                url: '{{ route('prints.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmPrint');
                        loadTablePrints();
                        $('#modalPrint').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deletePrint(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar estampado?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('prints.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTablePrints();
                        },'json');
                });
        }

    </script>

@endsection