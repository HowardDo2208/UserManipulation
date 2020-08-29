@extends('layouts.app')

@section('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{asset('js/users/chart.js')}}"></script>
@endsection


@section('content')
    <div class="container">
        <a href="/users/index">
            <button class="btn btn-primary">Back to users index</button>
        </a>
        <div id="chart_div">

        </div>
    </div>

@endsection


