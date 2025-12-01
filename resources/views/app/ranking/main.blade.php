@extends('layouts.app')

@section('content')

    <div class='row' id="mainDiv">
        <div class='col-lg-12'>
            <div class='ibox float-e-margins'>
                <div class='ibox-title'>
                    <h5>Calificación</h5>
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
                            <button type='button' class='btn btn-primary btn-block' onclick='loadTableComments()'>
                                <i class='fa fa-search'></i> Consultar
                            </button>                            
                        </div>
                        <div class='col-lg-9' id='divTableRanking'></div>
                        <div class='col-lg-12' id='divTableComments'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({width: "100%"});
            loadTableRanking();
        });

        function loadTableRanking(){

            $('#divTableRanking').load('{{ route('ranking.table') }}',
            {
                _token: '{{ csrf_token() }}'
            });
        }
        
        function loadTableComments(){
            filterBranchOffice = $("#filterBranchOffice").find(':selected').val();

            $('#divTableComments').load('{{ route('ranking.tableComments') }}',
            {
                _token: '{{ csrf_token() }}',
                cve: filterBranchOffice
            });
        }
    </script>

@endsection