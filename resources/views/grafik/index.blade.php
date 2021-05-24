@extends('template')
@section('content')
    <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="chart">
                    <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div> 
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <script>
        $(function () {
            let data = JSON.parse("{{$month}}");
            let data1 = JSON.parse("{{$month1}}");
            let data2 = JSON.parse("{{$month2}}");
            // console.log(data2);
            //--------------
            //- BAR CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mai', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [
                {
                    label               : 'Waiting List',
                    backgroundColor     : '#dc3545',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : data
                },
                {
                    label               : 'On Progress',
                    backgroundColor     : '#ffc107',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)', 
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : data1
                },
                {
                    label               : 'Done',
                    backgroundColor     : '#28a745',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)', 
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : data2
                },
                ]
            }

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }

            // This will get the first returned node in the jQuery collection.
            var areaChart       = new Chart(areaChartCanvas, {
                type: 'bar',
                data: areaChartData,
                options: barChartOptions
            })
        })
    </script>

@endsection