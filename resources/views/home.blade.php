@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($modules as $categ)
            <div class="panel panel-default">
                <div class="panel-heading">{{ $categ['name'] }}</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($categ['modules'] as $modulo)
                            <div class="col-md-2 col-sm-4">
                                <div class="panel panel-default" style="height: 150px">
                                    <div class="panel-body" align="center">
                                        <i style="color: #345C9B" class="{{ $modulo['icon'] }} fa-3x"></i>
                                        <p>{{ $modulo['name'] }}</p>
                                        <a href="{{ route($modulo['url']) }}" class="btn btn-white">
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
