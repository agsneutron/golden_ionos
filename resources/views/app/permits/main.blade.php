@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Permisos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='newProfile(this)'>
                                <i class="fa fa-plus"></i> Nuevo rol
                            </button>
                        </div>
                        <div class='col-lg-6'>
                            <table class="table table-hover margin bottom">
                                <thead>
                                <tr>
                                    <th style="width: 1%" class="text-center">#</th>
                                    <th >Perfil</th>
                                    <th ></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $n = 1; ?>
                                @foreach($types as $type)
                                    <tr>
                                        <td class="text-center">{{ $n }}</td>
                                        <td>{{ $type['Description'] }}</td>
                                        <td class="text-center">
                                            <button type="button" onclick='editPermits({{ $type['Id'] }},this)' class="btn btn-outline btn-danger btn-circle">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $n++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class='col-lg-6' id="divPermits" style="background-color: #f9f9f9"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL USUARIO  -->
    <div class='modal inmodal' id='modalProfile' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalProfile'>Nuevo perfil</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmProfile' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='Id' name='Id' value="0">
                        <div class="form-group">
                            <label>Nombre del perfil: <span class='text-danger'>(*)</span></label>
                            <input name='Description' id='Description' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Asignado a sucursal: <span class='text-danger'>(*)</span></label>
                            <select name='FlagAsignedBranch' id='FlagAsignedBranch' class='form-control'>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveProfile()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            //loadTableClients();
        });

        function editPermits(cve,e){
            $(e).blur();
            $('#divPermits').load('{{ route('permits.editPermits') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve:cve
                });
        }

        function newProfile(e){
            $(e).blur();
            $('#titleModalProfile').html('Nuevo cliente');
            resetForm('frmProfile');
            $('#Id').val(0);
            $('#modalProfile').modal('show');
        }

        function saveProfile(){
            $('#frmProfile').form('submit', {
                url: '{{ route('permits.saveProfile') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        $('#modalProfile').modal('hide');
                        window.location.reload()
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

    </script>

@endsection