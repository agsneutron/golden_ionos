@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Sucursales</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newBranchOffice(this)'>
                                <i class="fa fa-plus"></i> Nueva sucursal
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTableBranchOffices'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL USUARIO  -->
    <div class='modal inmodal' id='modalBranchOffice' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalBranchOffice'>Nueva sucursal</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmBranchOffice' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Nombre: <span class='text-danger'>(*)</span></label>
                            <input name='Name' id='Name' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Dirección: <span class='text-danger'>(*)</span></label>
                            <input name='Address' id='Address' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Código postas: <span class='text-danger'>(*)</span></label>
                            <input name='PostalCode' id='PostalCode' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Teléfono: <span class='text-danger'>(*)</span></label>
                            <input name='Phone' id='Phone' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Serie: <span class='text-danger'>(*)</span></label>
                            <input name='Series' id='Series' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>RFC: <span class='text-danger'>(*)</span></label>
                            <input name='Rfc' id='Rfc' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Email: <span class='text-danger'>(*)</span></label>
                            <input name='Email' id='Email' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Leyenda: <span class='text-danger'>(*)</span></label>
                            <input name='Legend' id='Legend' type='text' class='form-control'>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveBranchOffice()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTableBranchOffices();
        });


        function loadTableBranchOffices(){
            $('#divTableBranchOffices').load('{{ route('branch_offices.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newBranchOffice(e){
            $(e).blur();
            $('#titleModalBranchOffice').html('Nueva sucursal');
            resetForm('frmBranchOffice');
            $('#Id').val(0);
            $('#modalBranchOffice').modal('show');
        }

        function editBranchOffice(cve,e){
            $(e).blur();
            resetForm('frmBranchOffice');
            $('#titleModalBranchOffice').html('Editar sucursal');
            $.post('{{ route('branch_offices.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmBranchOffice').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalBranchOffice').modal('show');
            });
        }

        function saveBranchOffice(){
            $('#frmBranchOffice').form('submit', {
                url: '{{ route('branch_offices.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmBranchOffice');
                        loadTableBranchOffices();
                        $('#modalBranchOffice').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deleteBranchOffice(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar sucursal?',
                    text: 'Si tiene información ligada no podra eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('branch_offices.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTableBranchOffices();
                        },'json');
                });
        }

    </script>

@endsection