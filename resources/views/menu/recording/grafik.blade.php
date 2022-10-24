@extends('layouts.master')
@section('heading', 'Grafik')
@section('page')
  <li class="breadcrumb-item active">Grafik Laporan</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">
                  Filter Grafik Per Kandang
                  </h3>
               </div>
              <div class="card-body">
                <form action="/recording/grafik" method="GET" enctype="multipart/form-data">
                  @csrf
                  <div class="row filter-row">
                      <div class="col-lg-6">
                          <div class="form-group form-focus">
                              <select class="form-control" id="id_kandang" name="id_kandang">
                                  <option value="">-- Kode Kandang --</option>
                               @foreach ($kandang as $k)
                                  <option value="{{ $k->id }}">{{ $k->kd_kandang }}</option>
                              @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-0.5">
                          <button type="submit" class="btn btn-primary" style="margin-right: 4px; margin-left: 4px;"><i class="fa fa-search"></i> Cari</button>
                      </div>
                  </div>
              </form>
              </div>
          </div>
      </div>
  </div>
</div>

{{-- Grafik --}}
@if ($id_kandang) 
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @foreach ($get_kandang as $item )
                <div class="card-header"><b>Grafik HenDay</b> ( Kandang : {{$item->kd_kandang }} )</div>
                @endforeach
                <div class="card-body">                   
                    <div id="grafik_hd"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @foreach ($get_kandang as $item )
                <div class="card-header"><b>Grafik FCR</b> ( Kandang : {{$item->kd_kandang }} )</div>
                @endforeach
                <div class="card-body">                   
                    <div id="grafik_fcr"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @foreach ($get_kandang as $item )
                <div class="card-header"><b>Grafik Telur</b> ( Kandang : {{$item->kd_kandang }} )</div>
                @endforeach
                <div class="card-body">                   
                    <div id="grafik_telur"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
</div>                
@endif

@include('sweetalert::alert')
@endsection

@section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var nilaihd = <?php echo json_encode($standart_hd) ?>;
        var bulan = <?php echo json_encode($bulan) ?>;
        Highcharts.chart('grafik_hd', {
        title : {
            text  : 'Grafik HenDay Production'
        },
        xAxis : {
            categories  : bulan
        },
        yAxis : {
            title : {
            text : 'Nilai HenDay Production (%)'
            }
        },
        plotOption: {
            series: {
            allowPointSelect: true
            }
        },
        series: [
            {
            name: 'Nilai HD',
            data: nilaihd
            }
        ]
        });
    </script>

    <script type="text/javascript">
        var nilaifcr = <?php echo json_encode($standart_fcr) ?>;
        var bulan = <?php echo json_encode($bulan) ?>;
        Highcharts.chart('grafik_fcr', {
        title : {
            text  : 'Grafik FCR (Feed Conversion Ratio)'
        },
        xAxis : {
            categories  : bulan
        },
        yAxis : {
            title : {
            text : 'Nilai Feed Conversion Ratio (Kg))'
            }
        },
        plotOption: {
            series: {
            allowPointSelect: true
            }
        },
        series: [
            {
            name: 'Nilai FCR',
            data: nilaifcr
            }
        ]
        });
    </script>

    <script type="text/javascript">
        var telur = <?php echo json_encode($telur) ?>;
        var ayam = <?php echo json_encode($ayam) ?>;
        Highcharts.chart('grafik_telur', {
        chart: {
          type: 'column'
        },
        title : {
            text  : 'Grafik Produksi Telur'
        },
        xAxis : {
            categories  : ayam
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
    $(document).ready( function () {
    $('#recording-datatable').DataTable();
  } );
  </script>
@endsection