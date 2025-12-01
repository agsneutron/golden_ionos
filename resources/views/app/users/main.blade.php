@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Usuarios</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newUser(this)'>
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </div>
                        <div class='col-lg-12' id='divTableUsuarios'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL USUARIO  -->
    <div class='modal inmodal' id='modalUsuario' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalUsuario'>Nuevo usuario</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmUsuario' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Tipo de usuario: <span class='text-danger'>(*)</span></label>
                            <select name="IdUserType" id="IdUserType" class="form-control">
                                <option value="0">Seleccione...</option>
                                @foreach($userTypes as $userType)
                                    <option value="{{ $userType['Id'] }}" data-flagBranch="{{ $userType['FlagAsignedBranch'] }}">{{ $userType['Description'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="divInputSucursal">
                            <label>Sucursal asignada: <span class='text-danger'>(*)</span></label>
                            <select name="IdBranchOffice" id="IdBranchOffice" class="form-control">
                                <option value="0">Seleccione...</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                @endforeach
                            </select>
                        </div>
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
                    <button type='button' class='btn btn-primary' onclick='saveUser()'>
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
            $("#divInputSucursal").hide();
            loadTableUsers();

            $("#IdUserType").change(function(){
                if(parseInt($("#IdUserType").find(":selected").val()) != 00 ){
                    flag = $("#IdUserType").find(":selected").data("flagbranch");
                    if(parseInt(flag) == 1){
                        $("#divInputSucursal").show();
                    }else{
                        $("#divInputSucursal").hide();
                    }
                }else{
                    $("#divInputSucursal").hide();
                }

            });

        });


        function loadTableUsers(){
            $('#divTableUsuarios').load('{{ route('users.table') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function newUser(e){
            $(e).blur();
            $('#titleModalUsuario').html('Nuevo usuario');
            resetForm('frmUsuario');
            $('#id').val(0);
            $('#inputPassword').show();
            $('#modalUsuario').modal('show');
        }

        function editUser(cve,e){
            $(e).blur();
            resetForm('frmUsuario');
            $('#inputPassword').hide();
            $('#titleModalUsuario').html('Editar usuario');
            $.post('{{ route('users.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmUsuario').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalUsuario').modal('show');
            });
        }

        function saveUser(){
            $('#frmUsuario').form('submit', {
                url: '{{ route('users.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmUsuario');
                        loadTableUsers();
                        $('#modalUsuario').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deleteUser(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar usuario?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('users.delete') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTableUsers();
                        },'json');
                });
        }


        function changePasswordUser(cve,e){
            $(e).blur();
            resetForm('frmNewPassword');
            $('#IdUser').val(cve);
            $('#modalNewPassword').modal('show');
        }

        function saveNewPassword(){
            $('#frmNewPassword').form('submit', {
                url: '{{ route('users.changePassword') }}',
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
    </script>

@endsection