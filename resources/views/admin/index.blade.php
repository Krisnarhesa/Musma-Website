@extends('/admin/layouts/master',['title'=>'Dashboard'])
@section('content')

<!-- Small boxes (Stat box) -->
<!-- ############ PAGE START-->
<div ui-view class="app-body" id="view">

  <!-- ############ PAGE START-->
  <div class="row no-gutter">
    <div class="col-md-5 col-lg-4 v-b">
      <div class="padding">
        <div class="box">
          <div class="box-header b-b">
            <h3 class="text-u-c text-muted">Posisi Sementara</h3>
          </div>
          <ul class="list inset">
            <div class="title-post mt-3">
              <h4 class="ml-3">SMFT</h4>
            </div>
            <hr>
            @foreach ($data['smft'] as $item)


            <li class="list-item">
              <div herf class="list-left">
                <span class="w-40 circle danger">
                  <strong class="text-lg">{{ $loop->iteration }}</strong>
                </span>
              </div>
              <div class="list-body">
                <div><a href class="_600 ">{{$item->nama_panggilan}}</a>

                </div>

                <small class="text-muted">Vote : {{$item->voted}} </small>
              </div>
            </li>
            @endforeach
            <hr>
            <div class="title-post">
              <h4 class="ml-3">BPMFT</h4>
            </div>
            <hr>
            @foreach ($data['bpmft'] as $item)
            <li class="list-item">
              <div herf class="list-left">
                <span class="w-40 circle danger">
                  <strong class="text-lg">{{$loop->iteration}}</strong>
                </span>
              </div>
              <div class="list-body">
                <div><a href class="_600">{{$item->nama_panggilan}}</a></div>
              </div>
              <small class="text-muted">Vote : {{$item->voted}} </small>
            </li>
            @endforeach
          </ul>
        </div>

      </div>
    </div>
    <div class="col-md-7 col-lg-8 v-b">
      <div class="padding">
        <div class="box chart">
          <div class="box-header b-b">
            <h3 class="text-u-c text-muted">Persentase Pemilih</h3>
          </div>
          <div class="box-body">
    <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
        [
          {data: [{{ $data['jml_milih'] }}], label: 'Memilih'},
          {data: [{{ $data['jml_golput'] }}], label: 'Golput'}
        ],
        {
          series: {
            pie: { show: true, innerRadius: 0, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } }
          },
          legend: { backgroundColor: 'transparent' },
          colors: ['#4caf50', '#f44336'],
          grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
          tooltip: true,
          tooltipOpts: { content: '%s: %p.0%' }
        }
    " style="height:465px"></div>
</div>
<div style="display: flex; justify-content: center; gap: 50px; padding: 10px">
    <p style="font-weight: bold">Total Terverifikasi : {{ $data['jml_milih'] + $data['jml_golput'] }}</p>
    <p style="font-weight: bold">Jumlah Memilih : {{ $data['jml_milih'] }}</p>
    <p style="font-weight: bold">Jumlah Golput : {{ $data['jml_golput'] }}</p>
</div>

      </div>
    </div>
    <div class="col-md-7 col-lg-12 v-b">
      <div class="padding">
        <div class="box chart">
          <div class="box-header b-b">
            <h3 class="text-u-c text-muted">Rincian Vote</h3>
          </div>
          <div class="row p-3 p-lg-5">
            <div class="item col-md-6">
              <p for="charSMFT" class="text-center font-weight-bold"># Vote SMFT</p>
              <canvas id="smft" width="250" height="150"></canvas>
            </div>
            <div class="item col-md-6">
              <p for="charSMFT" class="text-center font-weight-bold"># Vote BPMFT</p>
              <canvas id="bpmft" width="250" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<!-- ############ PAGE END-->

</div>
</div>
<!-- / -->

<!-- theme switcher -->


@endsection
@section('footer')
<script>
  var cSmft = document.getElementById('smft');
	var cBpmft = document.getElementById('bpmft');

	loadDataChart();
	function loadDataChart(){
		$.ajax({
			url: '{{Route("chart")}}',
			type: 'get',
			success: function(data){
				chart = JSON.parse(data);
        console.log(chart);
				updateChart(chart);
			}
		});
	}

	// Deklarasikan variabel global
var chartSMFT = null;
var chartBPMFT = null;

function updateChart(data) {
    var smft_calons = Object.keys(data.SMFT);
    var bpmft_calons = Object.keys(data.BPMFT);

    if (!smft_calons.length || !bpmft_calons.length) {
        console.error("Tidak ada data untuk SMFT atau BPMFT");
        return;
    }

    var prodis = data.SMFT[smft_calons[0]].prodis || [];
    if (!prodis.length) {
        console.error("Tidak ada data prodi");
        return;
    }

    var datasmft = {
        labels: prodis,
        datasets: smft_calons.map((calon, index) => ({
            label: calon,
            backgroundColor: index === 0 ? 'rgba(255, 99, 132, 0.2)' : 'rgba(54, 162, 235, 0.2)',
            borderColor: index === 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: data.SMFT[calon]?.prodi_value || []
        }))
    };

    var databpmft = {
        labels: prodis,
        datasets: bpmft_calons.map((calon, index) => ({
            label: calon,
            backgroundColor: `rgba(${index * 50 + 100}, ${index * 70 + 50}, ${index * 90 + 20}, 0.2)`,
            borderColor: `rgba(${index * 50 + 100}, ${index * 70 + 50}, ${index * 90 + 20}, 1)`,
            borderWidth: 1,
            data: data.BPMFT[calon]?.prodi_value || []
        }))
    };

    // Hancurkan chart sebelumnya jika sudah ada
    if (chartSMFT) chartSMFT.destroy();
    if (chartBPMFT) chartBPMFT.destroy();

    // Buat chart baru
    chartSMFT = new Chart(cSmft, {
        type: 'bar',
        data: datasmft,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    chartBPMFT = new Chart(cBpmft, {
        type: 'bar',
        data: databpmft,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}
</script>
@endsection