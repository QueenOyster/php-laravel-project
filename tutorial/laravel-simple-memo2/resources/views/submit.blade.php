@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>

@section('content')
{{--    {{dd( $submit_memo )}}--}}
<div class="col-sm-12 col-md-6 p-0">
    <div class="card">
        <div class="card-header d-flex justify-content-between my-card-header">
            To-do Submit
        </div>

        <form class="card-body my-card-body mb-0" action="{{ route('enroll') }}" method="POST">
            <input type="hidden" name="memo_id" value="{{ $submit_memo[0]['id'] }}" />

            <div class="form-group mb-3">
                <p>To-do Content</p>
                {{ $submit_memo[0]['content'] }}
            </div>

            <div class="form-group mb-3">
                Content's Detail
                @csrf
                <textarea class="form-control" name="detail" rows="3" placeholder="input detail here"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">enroll</button>
        </form>

    </div>
</div>
@endsection

@section('logs')
    <div class="col-sm-12 col-md-4 p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between my-card-header">Daily Completed Tasks</div>
            <div class="card-body my-card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Content</th>
                        <th scope="col">Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div id="num" style="display:none">{{ $num = 0 }}</div>
                    @foreach($logs as $log)
                        <div id="num" style="display:none">{{ $num += 1 }}</div>
                        <tr>
                            <th scope="row">{{ $num }}</th>
                            <td>{{ $log['content'] }}</td>
                            <td>{{ $log['detail'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('chart')
    <div class="col-sm-12 col-md-6 p-0 ">
        <div class="card">
            <div class="card-header d-flex justify-content-between my-card-header">Month's Daily Completed Tasks</div>
            <div class="card-body my-card-body">

                {{--                {{ dd(json_encode($chartData))  }}--}}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                <canvas id="bar-chart" width="250" height="80"></canvas>
                <script>
                    new Chart(document.getElementById("bar-chart"), {
                        type: 'bar',
                        data: {
                            // labels: ['Apple', 'banana', 'Citrus', "Dolce"],
                            {{--                            labels: [@foreach($chartData as $chartDatum){{　date_format(date_create($chartDatum->date), 'md') .  ", "  }}@endforeach],--}}
                            labels: [@foreach($chartData as $chartDatum){{ date_format(date_create($chartDatum->date), 'd'). ", "  }}@endforeach],
                            datasets: [
                                {
                                    label: "Tasks",
                                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                    data: [@foreach($chartData as $chartDatum){{ $chartDatum->tasks . ", "   }}@endforeach]
                                }
                            ]
                        },
                        options: {
                            legend: { display: false },
                            // maxWidth: { 6 },
                            title: {
                                display: true,
                                text: 'Daily Completed Tasks'
                            },

                            scales: {
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Date'
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontSize : 14,
                                        callback: function(value) {if (value % 1 === 0) {return value;}}
                                    }
                                }]
                            },


                        }});
                </script>


            </div>

        </div>
    </div>


@endsection


