@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Colores</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newColor(this)'>
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTableColors'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ARTICLE -->
    <div class='modal inmodal' id='modalColor' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalColor'>Nuevo color</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmColor' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Descripción: <span class='text-danger'>(*)</span></label>
                            <input name='Description' id='Description' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Código: <span class='text-danger'>(*)</span></label>
                            <!--<input name='Code' id='Code' type='text' class='form-control'>-->
                            <input type="text" name='Code' id='Code' type='text' class="form-control demo1" value="#ffffff" />
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveColor()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTableColors();
            $('.demo1').colorpicker();
        });


        function loadTableColors(){
            $('#divTableColors').load('{{ route('colors.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newColor(e){
            $(e).blur();
            $('#titleModalColor').html('Nuevo color');
            resetForm('frmColor');
            $('#Id').val(0);
            $('#modalColor').modal('show');
        }

        function editColor(cve,e){
            $(e).blur();
            resetForm('frmColor');
            $('#titleModalColor').html('Editar color');
            $.post('{{ route('colors.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmColor').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalColor').modal('show');
            });
        }

        function saveColor(){
            $('#frmColor').form('submit', {
                url: '{{ route('colors.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmColor');
                        loadTableColors();
                        $('#modalColor').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deleteColor(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar color?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('colors.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTableColors();
                        },'json');
                });
        }

    </script>

@endsection