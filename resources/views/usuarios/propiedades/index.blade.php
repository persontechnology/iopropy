@extends('layouts.app',['title'=>'Propiedades'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('usuarios') }}
@endsection



@section('content')

<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 100vh;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
<div class="card">
  <div class="card-body">
    	<div class="table-responsive">
        	{!! $dataTable->table()  !!}
        </div>
  </div>
  <div class="card-foot">
    <div id="map"></div>
  </div>
</div>
{!! $dataTable->scripts() !!}

<script>
    $('#m_usuarios').addClass('active');
    
    function initMap() {

        var locations = [
            @foreach($user->propiedadesActuales as $pa)
                @if($pa->latitud)
                ['<b>Código:</b> {{ $pa->codigo }} <a href="{{ route('informacionPropiedad',$pa->id) }}"> Ver información</a>', {{ $pa->latitud }},{{ $pa->longitud }}],
                @endif
             @endforeach

        ];
        var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 9,
             center: new google.maps.LatLng(-2.601847, -77.971980),
             mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    
        var infowindow = new google.maps.InfoWindow;
    
        var marker, i;
    
        for (i = 0; i < locations.length; i++) {  
            marker = new google.maps.Marker({
                 position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                 map: map
            });
    
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                 return function() {
                     infowindow.setContent(locations[i][0]);
                     infowindow.open(map, marker);
                 }
            })(marker, i));
        }
    }    
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bcJ39miYRDXIr4ux3484nqQP1XqS9Bw&callback=initMap">
    </script>
@endsection
