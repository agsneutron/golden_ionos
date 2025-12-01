@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Artículos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newArticle(this)'>
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTableArticles'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ARTICLE -->
    <div class='modal inmodal' id='modalArticle' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalArticle'>Nuevo artículo</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmArticle' method='POST' autocomplete="off">
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
                    <button type='button' class='btn btn-primary' onclick='saveArticle()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTableArticles();
        });


        function loadTableArticles(){
            $('#divTableArticles').load('{{ route('articles.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newArticle(e){
            $(e).blur();
            $('#titleModalArticle').html('Nuevo artículo');
            resetForm('frmArticle');
            $('#Id').val(0);
            $('#modalArticle').modal('show');
        }

        function editArticle(cve,e){
            $(e).blur();
            resetForm('frmArticle');
            $('#titleModalArticle').html('Editar artículo');
            $.post('{{ route('articles.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmArticle').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalArticle').modal('show');
            });
        }

        function saveArticle(){
            $('#frmArticle').form('submit', {
                url: '{{ route('articles.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmArticle');
                        loadTableArticles();
                        $('#modalArticle').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deleteArticle(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar artículo?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('articles.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTableArticles();
                        },'json');
                });
        }

    </script>

@endsection