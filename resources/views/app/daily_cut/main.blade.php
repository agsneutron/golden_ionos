@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Monederos electronicos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        @if(Auth::user()->id_branch_office == null)
                            <div class='col-lg-3'>
                                <div class="form-group" >
                                    <label>Sucursal:</label>
                                    <select name="filterBranchOffice" id="filterBranchOffice" class="form-control">
                                        <option value="0">Seleccione...</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class='col-lg-3'>
                            <div class="form-group">
                                <label>Fecha:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filterDay" name="filterDay" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-6'>
                            <button type='button' class='btn btn-white ' onclick='viewDailyCut()'>
                                <i class='fa fa-search'></i> Consultar
                            </button>
                            <button type='button' class='btn btn-white' onclick='printDailyCut()'>
                                <i class='fa fa-print'></i> Imprimir
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-6"><h3>Efectivo</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-info" id="totalCash">-</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6"><h3>Tarjetas</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-info" id="totalCards">-</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6"><h3>Transferencia</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-info" id="totalTransfer">-</h3>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-lg-6"><h3>Total ingresos</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-info" id="totalIncome">-</h3>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-lg-6"><h3>Egresos</h3></div>
                                <div class="col-lg-6" align="right">
                                    <h3 class="text-danger" id="totalExpenses">-</h3>
                                </div>
                            </div>
                            <div class="hr-line-solid"></div>
                            <div class="row">
                                <div class="col-lg-6"><h2>Total</h2></div>
                                <div class="col-lg-6" align="right">
                                    <h2 class="text-success" id="total">-</h2>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-9">
                            <div class="row">
                                <h1 class="text-success">Ingresos</h1>
                                <div class='col-lg-12' id='divTableCash'></div>
                                <div class='col-lg-12' id='divTableCard'></div>
                                <div class='col-lg-12' id='divTableTransfer'></div>
                                <div class='col-lg-12'>
                                    <div class="hr-line-solid"></div>
                                </div>
                                <h1 class="text-danger">Egresos</h1>
                                <div class='col-lg-12' id='divTableExpense'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});

            var mem = $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });
        });

        function printDailyCut(){
            @if(Auth::user()->id_branch_office != null)
                var filterBranchOffice = '{{ Auth::user()->id_branch_office }}';
            @else
                var filterBranchOffice = $("#filterBranchOffice").find(":selected").val();
            @endif
            day = $("#filterDay").val();
            url = "{{ route('daily_cut.printDailyCut', array(':branch',':day'))  }}";
            url = url.replace(':branch', filterBranchOffice);
            url = url.replace(':day', day);
            console.log(url);
            window.open(url,
                '_blank',
                'fullscreen=yes,directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no');
        }

        function viewDailyCut(){

            @if(Auth::user()->id_branch_office != null)
                var filterBranchOffice = '{{ Auth::user()->id_branch_office }}';
            @else
                var filterBranchOffice = $("#filterBranchOffice").find(":selected").val();
            @endif
            $('#divTableCash').load('{{ route('daily_cut.tableCash') }}',
                {
                    _token: '{{ csrf_token() }}',
                    day: $("#filterDay").val(),
                    filterBranchOffice: filterBranchOffice
                });

            $('#divTableCard').load('{{ route('daily_cut.tableCard') }}',
                {
                    _token: '{{ csrf_token() }}',
                    day: $("#filterDay").val(),
                    filterBranchOffice: filterBranchOffice
                });
            
            $('#divTableTransfer').load('{{ route('daily_cut.tableTransfer') }}',
                {
                    _token: '{{ csrf_token() }}',
                    day: $("#filterDay").val(),
                    filterBranchOffice: filterBranchOffice
                });

            $('#divTableExpense').load('{{ route('daily_cut.tableExpenses') }}',
                {
                    _token: '{{ csrf_token() }}',
                    day: $("#filterDay").val(),
                    filterBranchOffice: filterBranchOffice
                });


            efectivo = 0;
            tarjeta = 0;
            transferencia = 0;
            ingresos = 0;
            egresos = 0;
            total = 0;
            $.ajax({
                type: "POST",
                url: '{{ route('daily_cut.requestTotals') }}',
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    day: $("#filterDay").val(),
                    filterBranchOffice: filterBranchOffice
                },
                dataType: 'json',
                success : function(data) {
                    $("#totalCash").html("$"+data.TotalCash);
                    $("#totalCards").html("$"+data.TotalCard);
                    $("#totalTransfer").html("$"+data.TotalTransfer);
                    $("#totalIncome").html("$"+data.TotalIncome);
                    $("#totalExpenses").html("$"+data.TotalExpense);
                    $("#total").html("$"+data.Total);
                }
            });
        }


    </script>

@endsection