@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Reporte de gastos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
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
                            <button type='button' class='btn btn-primary btn-block' onclick='loadReport()'>
                                <i class='fa fa-search'></i> Buscar
                            </button>
                        </div>
                        <div class='col-lg-9' id='chartReport'>
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                        <div class='col-lg-12' id='tableReport'></div>
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

            colores = [
                '#9BCE57' ,
                '#5F1D6F',
                '#E90032',
                '#D37526',
                '#115C52' ];

            Highcharts.setOptions({
                colors: Highcharts.map(colores, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });
        });


        function loadReport(){
            $("#container").empty();

            $.ajax({
                type: "POST",
                url: '{{ route('expense_report.loadReport') }}',
                async: false,
                data:{
                    _token: '{{ csrf_token() }}',
                    IdBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                    startDay: $("#filterStartDay").val(),
                    endDay: $("#filterEndDay").val()
                },
                dataType: 'json',
                success : function(data) {
                    if(data.success){
                        // Create the chart
                        Highcharts.chart('container', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: data.textReport
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: 'Total en pesos'
                                }

                            },
                            legend: {
                                enabled: false
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        //format: '{point.y:.1f}%'
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
                            },

                            series: [
                                {
                                    name: "Conceptos",
                                    colorByPoint: true,
                                    data: data.series
                                }
                            ]
                        });

                    }else{
                        alertaError('Error',data.errorMsg);
                    }
                }
            });

            $('#tableReport').load('{{ route('expense_report.table') }}',
                {
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val()
                });
        }
    </script>

@endsection