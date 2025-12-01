@extends('layouts.app')

@section('content')

    <div class='row' id="mainDiv">
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Reporte de entregas</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-3" >
                            <div class="form-group" >
                                <label>Sucursal:</label>
                                <select name="filterBranchOffice" id="filterBranchOffice" class="form-control">
                                    <option value="0">Seleccione...</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch['Id'] }}">{{ $branch['Name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group" >
                                <label>Servicio:</label>
                                <select name="filterCategory" id="filterCategory" class="form-control">
                                    <option value="0">Seleccione...</option>
                                    @foreach($serviceCategories as $category)
                                        <option value="{{ $category['Id'] }}">{{ $category['Description'] }}</option>
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

                            <button type='button' class='btn btn-primary btn-block' onclick='searchDeliveries()'>
                                <i class='fa fa-search'></i> Consultar
                            </button>
                        </div>
                        <div class="col-lg-9" id="divTableDeliveries"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

      $(document).ready(function() {  
          var mem = $('.input-group.date').datepicker({
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              calendarWeeks: true,
              autoclose: true,
              format: "yyyy-mm-dd"
          });
          
          searchDeliveries();
      });

      function searchDeliveries(){
            console.log('searchDeliveries');
            $('#divTableDeliveries').load("{{ route('delivery_report.table') }}",
            {
                  _token: '{{ csrf_token() }}',
                  filterBranchOffice: $("#filterBranchOffice").find(":selected").val(),
                  filterCategory: $("#filterCategory").find(":selected").val(),
                  filterStartDay: $("#filterStartDay").val(),
                  filterEndDay: $("#filterEndDay").val()
            },function(){
                // window.scrollTo(0,document.body.scrollHeight);
            });
      }

    </script>

@endsection
