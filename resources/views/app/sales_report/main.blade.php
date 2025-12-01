@extends('layouts.app')

@section('content')

    <div class='row'>
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Reporte de ventas</h5>
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
                                    <input type="text" class="form-control" id="filterStartDay" name="filterStartDay" value="{{ date('Y-m') }}-01">
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
                            <div id="containerCategory" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                        <div class='col-lg-12' id='chartReport'>
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                        <div class='col-lg-12' id='tableReport'></div>
                        <div class='col-lg-12' id='tableBestClients'></div>
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
                '#115C52',
                '#0000FF',
                '#8A2BE2',
                '#A52A2A',
                '#DEB887',
                '#5F9EA0',
                '#7FFF00',
                '#D2691E',
                '#FF7F50',
                '#6495ED',
                '#FFF8DC',
                '#DC143C',
                '#00FFFF',
                '#00008B',
                '#008B8B',
                '#B8860B',
                '#A9A9A9',
                '#006400',
                '#A9A9A9',
                '#BDB76B',
                '#8B008B',
                '#556B2F',
                '#FF8C00',
                '#9932CC',
                '#8B0000',
                '#E9967A',
                '#8FBC8F',
                '#483D8B',
                '#2F4F4F',
                '#2F4F4F',
                '#00CED1',
                '#9400D3',
                '#FF1493',
                '#00BFFF',
                '#696969',
                '#696969',
                '#1E90FF',
                '#B22222',
                '#FFFAF0',
                '#228B22',
                '#FF00FF',
                '#DCDCDC',
                '#F8F8FF',
                '#FFD700',
                '#DAA520',
                '#808080',
                '#008000',
                '#ADFF2F',
                '#808080',
                '#F0FFF0',
                '#FF69B4',
                '#CD5C5C',
                '#4B0082',
                '#FFFFF0',
                '#F0E68C',
                '#E6E6FA',
                '#FFF0F5',
                '#7CFC00',
                '#FFFACD',
                '#ADD8E6',
                '#F08080',
                '#E0FFFF',
                '#FAFAD2',
                '#D3D3D3',
                '#90EE90',
                '#D3D3D3',
                '#FFB6C1',
                '#FFA07A',
                '#20B2AA',
                '#87CEFA',
                '#778899',
                '#778899',
                '#B0C4DE',
                '#FFFFE0',
                '#00FF00',
                '#32CD32',
                '#FAF0E6',
                '#FF00FF',
                '#800000',
                '#66CDAA',
                '#0000CD',
                '#BA55D3',
                '#9370D8',
                '#3CB371',
                '#7B68EE',
                '#00FA9A',
                '#48D1CC',
                '#C71585',
                '#191970',
                '#F5FFFA',
                '#FFE4E1',
                '#FFE4B5',
                '#FFDEAD',
                '#000080',
                '#FDF5E6',
                '#808000',
                '#6B8E23',
                '#FFA500',
                '#FF4500',
                '#DA70D6',
                '#EEE8AA',
                '#98FB98',
                '#AFEEEE',
                '#D87093',
                '#FFEFD5',
                '#FFDAB9',
                '#CD853F',
                '#FFC0CB',
                '#DDA0DD',
                '#B0E0E6',
                '#800080',
                '#FF0000',
                '#BC8F8F',
                '#4169E1',
                '#8B4513',
                '#FA8072',
                '#F4A460',
                '#2E8B57',
                '#FFF5EE',
                '#A0522D',
                '#C0C0C0',
                '#87CEEB',
                '#6A5ACD',
                '#708090',
                '#708090',
                '#FFFAFA',
                '#00FF7F',
                '#4682B4',
                '#D2B48C',
                '#008080',
                '#D8BFD8',
                '#FF6347',
                '#40E0D0',
                '#EE82EE',
                '#F5DEB3',
                '#FFFFFF',
                '#F5F5F5',
                '#FFFF00',
                '#9ACD32',
            ];

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
            loadReport();
        });


        function loadReport(){
            $("#container").empty();

            $.ajax({
                type: "POST",
                url: '{{ route('sales_report.loadReportCategory') }}',
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
                        Highcharts.chart('containerCategory', {
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
                                        format: '${point.y:.1f}'
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>$ {point.y}</b><br/>'
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

            $.ajax({
                type: "POST",
                url: '{{ route('sales_report.loadReport') }}',
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
                                        format: '${point.y:.1f}'
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>$ {point.y}</b><br/>'
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



            $('#tableReport').load("{{ route('sales_report.table') }}",
                {
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val()
                });
            
            $('#tableBestClients').load("{{ route('sales_report.table_best_clients') }}",
                {
                    _token: '{{ csrf_token() }}',
                    filterBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                    filterStartDay: $("#filterStartDay").val(),
                    filterEndDay: $("#filterEndDay").val()
                });

        }
    </script>

@endsection