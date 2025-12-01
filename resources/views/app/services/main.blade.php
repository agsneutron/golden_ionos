@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Servicios</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class='col-lg-12' id='divTableCategories'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CATEGORY  -->
    <div class='modal inmodal' id='modalCategory' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalCategory'>Nueva  categoria</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmCategory' method='POST' autocomplete="off">
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
                    <button type='button' class='btn btn-primary' onclick='saveCategory()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL SERVICE  -->
    <div class='modal inmodal' id='modalService' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalService'>Nuevo servicio</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmService' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='IdCategory' name='IdCategory' value="0">
                        <input type='hidden' id='IdService' name='IdService' value="0">
                        <div class="form-group">
                            <label>Descripción: <span class='text-danger'>(*)</span></label>
                            <input name='DescriptionService' id='DescriptionService' type='text' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Precio normal: <span class='text-danger'>(*)</span></label>
                            <input name='NormalPrice' id='NormalPrice' type='number' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Precio urgente: <span class='text-danger'>(*)</span></label>
                            <input name='UrgentPrice' id='UrgentPrice' type='number' class='form-control'>
                        </div>
                        <div class="form-group">
                            <label>Precio extra urgente: <span class='text-danger'>(*)</span></label>
                            <input name='ExtraUrgentPrice' id='ExtraUrgentPrice' type='number' class='form-control'>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveService()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>



    <script>
        selectedCategory = 0;
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTableCategories();
        });


        function loadTableCategories(){
            $('#divTableCategories').load('{{ route('services.tableCategories') }}',
                {
                    _token: '{{ csrf_token() }}'
                });
        }

        function showServices(cve,e){
            selectedCategory = cve;
            $('#divTableCategories').load('{{ route('services.tableServices') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve:cve
                });
        }

        function newCategory(e){
            $(e).blur();
            $('#titleModalCategory').html('Nueva categoria');
            resetForm('frmCategory');
            $('#Id').val(0);
            $('#modalCategory').modal('show');
        }

        function editCategory(cve,e){
            $(e).blur();
            resetForm('frmCategory');
            $('#titleModalCategory').html('Editar categoria');
            $.post('{{ route('services.editCategory') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmCategory').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalCategory').modal('show');
            });
        }


        function newService(e){
            $(e).blur();
            $('#titleModalService').html('Nuevo servicio');
            resetForm('frmService');
            $('#IdCategory').val(selectedCategory);
            $('#IdService').val(0);
            $('#modalService').modal('show');
        }

        function editService(cve,e){
            $(e).blur();
            resetForm('frmService');
            $('#titleModalService').html('Editar servicio');
            $.post('{{ route('services.editService') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmService').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalService').modal('show');
            });
        }

        function saveCategory(){
            $('#frmCategory').form('submit', {
                url: '{{ route('services.saveCategory') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmCategory');
                        loadTableCategories();
                        $('#modalCategory').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function saveService(){
            $('#frmService').form('submit', {
                url: '{{ route('services.saveService') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmService');
                        showServices(selectedCategory,null);
                        $('#modalService').modal('hide')
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }

        function deleteCategory(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar categoría?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('services.deleteCategory') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            loadTableCategories();
                        },'json');
                });
        }

        function deleteService(cve,e){
            $(e).blur();
            swal(
                {
                    title: '¿Eliminar servicio?',
                    text: 'Si tiene información ligada no podrá eliminarse',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: false,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'

                }, function(){
                    $.post('{{ route('services.deleteService') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            cve:cve

                        },function (result) {
                            alertaSuccess('Correcto', result.errorMsg);
                            showServices(selectedCategory,null);
                        },'json');
                });
        }

        function unifyServices(e){
            $(e).blur();
            ids = [];
            $.each($("#dataTableServices tr.selected"), function (key, element) {
                //console.log(element);
                ids.push(parseInt($(element).data('id')));
            });
            if (ids.length >= 2){
                swal(
                {
                    title: '¿Unificar servicios seleccionados?',
                    text: '',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }, function(){
                    /*
                    setTimeout(function(){
                        swal( "Correcto" ,  "Servicios unificados correctamente" ,  "success" );
                    }, 3000);
                    */

                    $.ajax({
                        type: "POST",
                        url: '{{ route('services.unifyServices') }}',
                        async: true,
                        data:{
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        dataType: 'json',
                        success : function(data) {
                            if(data.success){
                                swal( "Correcto" ,  data.errorMsg ,  "success" );
                                showServices(selectedCategory,null);
                            }else{
                                swal("Error", data.errorMsg, "error");
                            }
                        }
                    });
                });
            }else{
                alertaError('Error', "Seleccione al menos 2 servicios");
            }
        }

    </script>

@endsection