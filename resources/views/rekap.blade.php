@extends('layouts/master',["title"=>"Rekapitulasi"])
@section('content')
<div role="main" class="main" id="home">
    <section
        class="page-header page-header-modern page-header-background page-header-background-lg overlay overlay-color-gradient overlay-show overlay-op-7"
        style="background-image: url(img/jumbotron.png);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1> <strong>REKAPITULASI SUARA BERDASARKAN PRODI</strong></h1>
                </div>

            </div>
        </div>
    </section>

    <section id="smft" class="container" style="width: 30%">
        <div class="title"  style="position: relative;top:25px;">
            <h1 class="text-center font-weight-bold">SMFT</h1>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">

                @foreach($rekap['SMFT'] as $key => $value)
                <li @if ($loop->index == 0)
                    class="active"
                    @endif data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($rekap['SMFT'] as $key => $value)

                <div class="carousel-item @php if($loop->index == 0) echo'active' @endphp">
                    <section class="container mb-3">
                        <div class="title">
                            <h3 class="text-center font-weight-bold">{{ $key }}</h3>
                        </div>
                        <br>

                        <div class="item card" style="box-shadow: 2px 3px 20px 0px #82767667; ">
                            <div class="p-4">
                                <canvas id="smft_prodi{{ $loop->index }}" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </section>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <br>
    <br>
    <section id="bpmft" class="container mt-1 mb-5" style="width: 30%">
        <div class="title" style="position: relative;top:20px;">
            <h1 class="text-center font-weight-bold">BPMFT</h1>
        </div>
        <div id="carouselExampleIndicator" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">

                @foreach($rekap['BPMFT'] as $key => $value)
                <li @if ($loop->index == 0)
                    class="active"
                    @endif data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($rekap['BPMFT'] as $key => $value)

                <div class="carousel-item @php if($loop->index == 0) echo'active' @endphp">
                    <section class="container mb-3">
                        <div class="title">
                            <h3 class="text-center font-weight-bold">{{ $key }}</h3>
                        </div>
                        <br>
                        <div class="item card" style="box-shadow: 2px 3px 20px 0px #82767667; ">
                            <div class="p-4">
                                <canvas id="bpmft_prodi{{ $loop->index }}" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </section>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicator" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicator" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</div>
@endsection

@section('footer')
<script>
    $('.carousel').carousel({
        interval: 5000
    })

    var rekap = {!! json_encode($rekap) !!};

    var i = 0;
    var ctx_smft = [];
    $.each(rekap.SMFT, function (key, val) {
        ctx_smft[i] = document.getElementById('smft_prodi'+i).getContext('2d');
        i++;
    });

    var i = 0;
    var ctx_bpmft = [];
    $.each(rekap.BPMFT, function (key, val) {
        ctx_bpmft[i] = document.getElementById('bpmft_prodi'+i).getContext('2d');
        i++;
    });

    i = 0;
    var myChartSMFT = [];
    $.each(rekap.SMFT, function (key, val) {
        myChartSMFT[i] = new Chart(ctx_smft[i], {
            type: 'bar',
            responsive : true,
            data: {
                labels: val.calon_names,
                datasets: [{
                    data: val.calon_votes,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
    	display: false
    },
    tooltips: {
    	callbacks: {
      	label: function(tooltipItem) {
        console.log(tooltipItem)
        	return tooltipItem.yLabel;
        }
      }
    },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        i++;
    });

    i = 0;
    var myChartBPMFT = [];
    $.each(rekap.BPMFT, function (key, val) {
        myChartBPMFT[i] = new Chart(ctx_bpmft[i], {
            type: 'bar',
            responsive : true,
            data: {
                labels: val.calon_names,
                datasets: [{
                    data: val.calon_votes,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
    	display: false
    },
    tooltips: {
    	callbacks: {
      	label: function(tooltipItem) {
        console.log(tooltipItem)
        	return tooltipItem.yLabel;
        }
      }
    },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        i++;
    });

</script>
@endsection