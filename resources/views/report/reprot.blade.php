@extends('layouts.app')
@section('title', __('Report | BD Mirror'))
@section('body-class', 'report-home')
@section('content')
<div class="report-wrapper">
    <table class="graph mt-3">
        <caption>All time complaint report</caption>
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Percent</th>
            </tr>
        </thead>
        <tbody>
            <tr style="height:{{ $complaint['road'] }}%">
                <th scope="row">Road <span class="text-danger">- ({{ $complaint['road'] }}%)</span></th>
                <td><span>{{ $complaint['road'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['bridge'] }}%">
                <th scope="row">Bridge <span class="text-danger">- ({{ $complaint['bridge'] }}%)</span></th>
                <td><span>{{ $complaint['bridge'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['transport'] }}%">
                <th scope="row">Transport <span class="text-danger">- ({{ $complaint['transport'] }}%)</span></th>
                <td><span>{{ $complaint['transport'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['water'] }}%">
                <th scope="row">Water Supply <span class="text-danger">- ({{ $complaint['water'] }}%)</span></th>
                <td><span>{{ $complaint['water'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['electricity'] }}%">
                <th scope="row">Electricity Supply <span class="text-danger">- ({{ $complaint['electricity'] }}%)</span></th>
                <td><span>{{ $complaint['electricity'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['waste'] }}%">
                <th scope="row">Waste Management <span class="text-danger">- ({{ $complaint['waste'] }}%)</span></th>
                <td><span>{{ $complaint['waste'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['human'] }}%">
                <th scope="row">Human Rights <span class="text-danger">- ({{ $complaint['human'] }}%)</span></th>
                <td><span>{{ $complaint['human'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['law'] }}%">
                <th scope="row">Law Enforcement <span class="text-danger">- ({{ $complaint['law'] }}%)</span></th>
                <td><span>{{ $complaint['law'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['health'] }}%">
                <th scope="row">Public Health <span class="text-danger">- ({{ $complaint['health'] }}%)</span></th>
                <td><span>{{ $complaint['health'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['municipal'] }}%">
                <th scope="row">Municipal Administration <span class="text-danger">- ({{ $complaint['municipal'] }}%)</span></th>
                <td><span>{{ $complaint['municipal'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['social'] }}%">
                <th scope="row">Social welfare <span class="text-danger">- ({{ $complaint['social'] }}%)</span></th>
                <td><span>{{ $complaint['social'] }}%</span></td>
            </tr>
            <tr style="height:{{ $complaint['economic'] }}%">
                <th scope="row">Economic Development <span class="text-danger">- ({{ $complaint['economic'] }}%)</span></th>
                <td><span>{{ $complaint['economic'] }}%</span></td>
            </tr>
        </tbody>
    </table>
    <div class="status-trace">
        <canvas id="pie-chart"></canvas>
        <script>
            var ctx = document.getElementById('pie-chart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie'
                , data: {
                    labels: ['Red', 'Blue', 'Yellow']
                    , datasets: [{
                        data: [12, 19, 3]
                        , backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                    }]
                }
            });

        </script>
    </div>
</div>
@endsection
