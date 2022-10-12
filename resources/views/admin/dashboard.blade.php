@extends('layouts.master')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-kiwi-bird"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ayam Produktif</span>
              <span class="info-box-number">{{$populasi}} Ekor</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-egg"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Telur</span>
              <span class="info-box-number">{{$produksi}} Butir</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-box"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Produksi Telur</span>
              <span class="info-box-number">{{$telur_today}}/hari ini</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-boxes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Stok Pakan</span>
              <span class="info-box-number">{{number_format($pakan)}} Kg</span>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">Grafik Produksi Telur</div>
                      <div class="card-body">
                        <div class="chart-container"></div>
                        <canvas id="grafik_populasi"></canvas>
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">Grafik Pemberian Pakan</div>
                      <div class="card-body">
                        <div class="chart-container"></div>
                        <canvas id="grafik_pakan"></canvas>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">Grafik Telur</div>
                      <div class="card-body">                   
                          <div id="grafik_telur"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </section>
    </div>
  </div>         
@endsection


@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="highcharts/modules/exporting.js"></script>
<script src="highcharts/modules/export-data.js"></script>
    <script type="text/javascript">
        var telur = <?php echo json_encode($telur) ?>;
        var hari = <?php echo json_encode($hari) ?>;
        Highcharts.chart('grafik_telur', {
        chart: {
          type: 'column'
        },
        title : {
            text  : 'Grafik Produksi Telur Per Hari'
        },
        xAxis : {
            categories  : hari
        },
        yAxis : {
          min: 0,  
          title : {
            text : 'Total Telur (Butir)'
            }
        },
        plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
        series: [
            {
            name: 'telur',
            data: telur
            }
        ]
        });
    </script>

<script>
const ctx = document.getElementById('grafik_populasi');
const grafik_populasi = new Chart(ctx, {
    type: 'doughnut',
    data: {
    labels: [
    'Ayam Produktif',
    'Ayam Afkir',
    'Ayam Mati'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [{{$produktif}}, {{$afkir}}, {{$mati}}],
    backgroundColor: [
      'rgb(0, 138, 0)',
      'rgb(100, 118, 135)',
      'rgb(229, 20, 0)'
    ],
    hoverOffset: 4
  }]
    },
});
</script>

<script>
  const cty = document.getElementById('grafik_pakan');
  const grafik_pakan = new Chart(cty, {
      type: 'pie',
      data: {
      labels: [
      'Stok Tersedia',
      'Pakan Keluar'
    ],
    datasets: [{
      label: 'My First Dataset',
      data: [{{$pakan}}, {{$pakan_keluar}}],
      backgroundColor: [
        'rgb(0, 138, 0)',
        'rgb(100, 118, 135)'
      ],
      hoverOffset: 4
    }]
      },
  });
  </script>
@endsection



