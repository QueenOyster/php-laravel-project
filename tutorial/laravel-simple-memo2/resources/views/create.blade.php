@extends('layouts.app')

@section('content')
<div class="col-sm-12 col-md-6 p-0">
    <div class="card">
        <div class="card-header my-card-header">New Task Create</div>
        <form class="card-body my-card-body" action="{{ route('store') }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control mb-2" name="content" rows="3" placeholder="input memo here"></textarea>
            </div>
            @error('content')
                <div class="alert alert-danger">Please input some content!</div>
            @enderror

            @foreach($tags as $tag)
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $tag['id'] }}" value="{{ $tag['id'] }}">
                    <label class="form-check-label" for="{{ $tag['id'] }}"?>{{ $tag['name'] }}</label>
                </div>
            @endforeach
            <input type="text" class="form-control w-50 mb-2" name="new_tag" placeholder="please input new tag">
            <button type="submit" class="btn btn-primary">save</button>
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


