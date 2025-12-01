@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Clientes</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newClient(this)'>
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                            <button type='button' class='btn btn-outline btn-white' onclick='unifyClients(this)'>
                                <i class="fa fa-group"></i> Unificar clientes
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTableClients'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL USUARIO  -->
    <div class='modal inmodal' id='modalClient' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalClient'>Nuevo usuario</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmClient' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Nombre: <span class='text-danger'>(*)</span></label>
                            <input name='Name' id='Name' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Email: <span class='text-danger'>(*)</span></label>
                            <input name='Email' id='Email' type='email' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Teléfono: <span class='text-danger'>(*)</span></label>
                            <input name='Phone' id='Phone' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Notas: <span class='text-danger'>(*)</span></label>
                            <input name='Notes' id='Notes' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Dirección: <span class='text-danger'>(*)</span></label>
                            <input name='Address' id='Address' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Fraccionamiento: </label>
                            <input name='Suburb' id='Suburb' type='text' class='form-control'>
                        </div>
                        <fieldset id="inputPassword">
                            <div class="form-group" >
                                <label>Contraseña: <span class='text-danger'>(*)</span></label>
                                <input name='Password' id='Password' type='password' class='form-control'>
                            </div>
                            <div class="form-group">
                                <label>Confirmar contraseña: <span class='text-danger'>(*)</span></label>
                                <input name='ConfPassword' id='ConfPassword' type='password' class='form-control'>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveClient()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL NEW PASSWORD  -->
    <div class='modal inmodal' id='modalNewPassword' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalNewPassword'>Cambiar contraseña</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmNewPassword' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='IdUser' name='IdUser' value="0">
                        <div class="form-group" >
                            <label>Nueva contraseña: <span class='text-danger'>(*)</span></label>
                            <input name='NewPassword' id='NewPassword' type='password' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Confirmar nueva contraseña: <span class='text-danger'>(*)</span></label>
                            <input name='ConfNewPassword' id='ConfNewPassword' type='password' class='form-control'>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveNewPassword()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTableClients();
        });


        function loadTableClients(){
            $('#divTableClients').load('{{ route('clients.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newClient(e){
            $(e).blur();
            $('#titleModalClient').html('Nuevo cliente');
            resetForm('frmClient');
            $('#Id').val(0);
            $('#inputPassword').show();
            $('#modalClient').modal('show');
        }

        function editClient(cve,e){
            $(e).blur();
            resetForm('frmClient');
            $('#inputPassword').hide();
            $('#titleModalClient').html('Editar cliente');
            $.post('{{ route('clients.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmClient').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalClient').modal('show');
            });
        }

        function saveClient(){
            $('#frmClient').form('submit', {
                url: '{{ route('clients.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmClient');
                        loadTableClients();
                        $('#modalClient').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deleteClient(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar cliente?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('clients.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTableClients();
                        },'json');
                });
        }


        function changePasswordClient(cve,e){
            $(e).blur();
            resetForm('frmNewPassword');
            $('#IdUser').val(cve);
            $('#modalNewPassword').modal('show');
        }

        function saveNewPassword(){
            $('#frmNewPassword').form('submit', {
                url: '{{ route('clients.changePassword') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmNewPassword');
                        $('#modalNewPassword').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function unifyClients(e){
            $(e).blur();
            ids = [];
            $.each($("#dataTableUsuarios tr.selected"), function (key, element) {
                //console.log(element);
                ids.push(parseInt($(element).data('id')));
            });
            if (ids.length >= 2){
                swal(
                {
                    title: '¿Unificar clientes seleccionados?',
                    text: '',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }, function(){
                    
                    setTimeout(function(){
                        swal ( "Correcto" ,  "Clientes unificados correctamente" ,  "success" );
                    }, 3000);
                    
                    $.ajax({
                        type: "POST",
                        url: '{{ route('clients.unifyClients') }}',
                        async: false,
                        data:{
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        dataType: 'json',
                        success : function(data) {
                            if(data.success){
                                swal ( "Correcto" ,  data.errorMsg ,  "success" );
                                loadTableClients();
                            }else{
                                swal("Error", data.errorMsg, "error");
                            }
                        }
                    });
                    
                });
            }else{
                alertaError('Error', "Seleccione al menos 2 clientes");
            }
        }
    </script>

@endsection