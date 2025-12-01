@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Conceptos de gastos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newExpenseConcept(this)'>
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTableExpenseConcepts'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ARTICLE -->
    <div class='modal inmodal' id='modalExpenseConcept' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalExpenseConcept'>Nuevo concepto de gasto</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmExpenseConcept' method='POST' autocomplete="off">
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
                    <button type='button' class='btn btn-primary' onclick='saveExpenseConcept()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTableConcepts();
        });


        function loadTableConcepts(){
            $('#divTableExpenseConcepts').load('{{ route('expense_concepts.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newExpenseConcept(e){
            $(e).blur();
            $('#titleModalExpenseConcept').html('Nuevo concepto de gasto');
            resetForm('frmExpenseConcept');
            $('#Id').val(0);
            $('#modalExpenseConcept').modal('show');
        }

        function editExpenseConcept(cve,e){
            $(e).blur();
            resetForm('frmExpenseConcept');
            $('#titleModalExpenseConcept').html('Editar concepto de gasto');
            $.post('{{ route('expense_concepts.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmExpenseConcept').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalExpenseConcept').modal('show');
            });
        }

        function saveExpenseConcept(){
            $('#frmExpenseConcept').form('submit', {
                url: '{{ route('expense_concepts.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmExpenseConcept');
                        loadTableConcepts();
                        $('#modalExpenseConcept').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deleteExpenseConcept(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar concepto de gasto?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('expense_concepts.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTableConcepts();
                        },'json');
                });
        }

    </script>

@endsection