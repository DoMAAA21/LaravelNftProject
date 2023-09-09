{{-- @extends('layouts.base')
@section('body') --}}
    <style>
        .container-fluid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;

            /* fraction*/
        }
    </style>

    <div class="container-fluid">
        <div class="f">
            <canvas id="titleChart"></canvas>
        </div>

        <div class="s">
            <canvas id="salesChart"></canvas>
        </div>

        <div class="t">
            <canvas id="topChart"></canvas>
        </div>

        <div class="f">
            <canvas id="topcharChart"></canvas>
        </div>
        <div class="s">
            <canvas id="topnftChart"></canvas>
        </div>
        <div class="s">
            <canvas id="tradeChart"></canvas>
        </div>
    </div>

    </div>
{{-- @endsection --}}
