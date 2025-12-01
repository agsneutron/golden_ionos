@extends('layouts.app')

@section('content')

    <div class='row' id="mainDiv">
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Gastos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <button type='button' class='btn btn-outline btn-white' onclick='registerExpense(this)'>
                                <i class="fa fa-plus"></i> Registrar gasto
                            </button>
                        </div>

                        <div class='col-lg-3'>
                            @if(Auth::user()->id_branch_office == null)
                            <div class="form-group" >
                                <label>Sucursal:</label>
                                <select name="filterBranchOffice" id="filterBranchOffice" class="form-control">
                                    <option value="0">Seleccione...</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group">
                                <label>Desde:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filterStartDay" name="filterStartDay" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Hasta:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filterEndDay" name="filterEndDay" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>

                            <button type='button' class='btn btn-primary btn-block' onclick='searchExpenses()'>
                                <i class='fa fa-search'></i> Consultar
                            </button>
                        </div>
                        <div class='col-lg-9' id='divTableExpenses'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EXPENSE -->
    <div class='modal inmodal' id='modalExpense' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class='modal-title' id='titleModalExpense'>Registrar gasto</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>Los campos marcados con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    </div>

                    <form role='form' id='frmExpense' method='POST' autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='Id' name='Id' value="0">
                        @if(Auth::user()->id_branch_office != null)
                            <input type='hidden' id='IdBranchOffice' name='IdBranchOffice' value="0">
                        @else
                            <div class="form-group" >
                                <label>Sucursal:</label>
                                <select name="IdBranchOffice" id="IdBranchOffice" class="form-control">
                                    <option value="0">Seleccione...</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Concepto: <span class='text-danger'>(*)</span></label>
                            <select class="form-control" id="IdExpenseConcept" name="IdExpenseConcept">
                                <option value="0">Seleccione...</option>
                                @foreach($concepts as $concept)
                                    <option value="{{ $concept['Id'] }}">{{ $concept['Description'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Fecha: <span class='text-danger'>(*)</span></label>
                            <input class="form-control" type="date" id="DateExpense" name="DateExpense">
                        </div>
                        <div class="form-group">
                            <label>Monto: <span class='text-danger'>(*)</span></label>
                            <input class="form-control" type="number" id="Amount" name="Amount">
                        </div>
                        <div class="form-group">
                            <label>Descripción: <span class='text-danger'>(*)</span></label>
                            <input class="form-control" type="text" id="Description" name="Description">
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-white' data-dismiss='modal'>
                        <i class='fa fa-times'></i> Cerrar
                    </button>
                    <button type='button' class='btn btn-primary' onclick='saveExpense()'>
                        <i class='fa fa-check'></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(Auth::user()->id_branch_office != null)
            filterBranchOffice = parseInt('{{ Auth::user()->id_branch_office }}');
        @endif

        orderSelected = 0;
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            //loadTableColors()


            var mem = $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });


            @if(Auth::user()->id_branch_office != null)
                searchExpenses();
            @endif

        });


        @if(Auth::user()->id_branch_office == null)
        function searchExpenses(){
            $('#divTableExpenses').load('{{ route('expenses.searchExpenses') }}',
                {
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val()
                });
        }
        @else
        function searchExpenses(){
            $('#divTableExpenses').load('{{ route('expenses.searchExpenses') }}',
                {
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: filterBranchOffice,
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val()
                });
        }
        @endif

        function registerExpense(e){
            $(e).blur();
            $('#titleModalExpense').html('Registrar gasto');
            resetForm('frmExpense');
            $('#Id').val(0);
            $('#modalExpense').modal('show');
        }

        function editExpense(cve,e){
            $(e).blur();
            resetForm('frmExpense');
            $('#titleModalExpense').html('Editar gasto');
            $.post('{{ route('expenses.edit') }}',
                {
                    _token: '{{ csrf_token() }}',
                    cve: cve
                }, function (result) {
                    $('#frmExpense').form('load', result.data);
                }, 'json').always(function (result) {
                $('#modalExpense').modal('show');
            });
        }

        function saveExpense(){
            @if(Auth::user()->id_branch_office != null)
                $("#IdBranchOffice").val(filterBranchOffice);
            @endif

            $('#frmExpense').form('submit', {
                url: '{{ route('expenses.save') }}',
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.success){
                        alertaSuccess('Correcto', result.errorMsg);
                        resetForm('frmExpense');
                        searchExpenses();
                        $('#modalExpense').modal('hide');
                    }else{
                        alertaError('Error',result.errorMsg);
                    }
                }
            });
        }


    </script>

@endsection