@extends('layouts.app',['title' => 'Archivos de respaldos'])

@section('breadcrumbs')
    {{ Breadcrumbs::render('infoVenta',$venta) }}
@endsection

@section('acciones')

<div class="breadcrumb justify-content-center">
  <a href="{{ route('ventas') }}" class="breadcrumb-elements-item">
      <i class="fas fa-arrow-left"></i>
      Cancelar
  </a>
</div>
@endsection

@section('content')

<link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{asset('vendor/bootstrap-fileinput/js/plugins/purify.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/locales/es.js') }}"></script>



    <div class="card card-body">
            <form action="{{route('archivoGuardar')}}" method="post" enctype="multipart/form-data">
                
                @csrf
                <input type="hidden" name="idVenta" value="{{$venta->id}}" required="">
                <div class="box-body">
                    <div class="file-loading">
                        <input id="fotos" name="fotos[]" type="file" accept="application/pdf" multiple>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer mt-2">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fa fa-save"></i> Actualizar Archivos</button>
                </div>
          </form>
    </div>



<script>
  $('#m_inicio').addClass('active');
  var fotos=[];
   @foreach($venta->archivos as $archivo)
    fotos.push("{{ Storage::url('public/archivos/'.$archivo->direccion) }}")
   @endforeach



    $("#fotos").fileinput({
        showUpload:false,
        showCaption: false,
        allowedFileExtensions: ["pdf"],
        language: "es",
        theme: "fas",
        initialPreview: fotos,
        initialPreviewAsData: true,
        deleteExtraData: {
            '_token': '{{csrf_token()}}',
        },
        initialPreviewConfig: [
          @foreach($venta->archivos as $archi)
            {
              caption: "{{$archi->nombre}}", 
              downloadUrl: "{{ Storage::url('public/archivos/'.$archi->direccion) }}", 
              key: '{{$archi->id}}',
              url: "{{route('archivoEliminar')}}",
              type:'pdf'

          },
          @endforeach
        ],
        overwriteInitial: false,
        // initialCaption: "The Moon and the Earth",
    }).on('filesorted', function(event, params) {
        // console.log(params.stack.key)
        var idsArchivos=[];
        $.each( params.stack, function( key, value ) {
          idsArchivos.push(value.key);
        });
        
        $.get( "{{route('archivosOrdenar')}}", { "ids[]":idsArchivos } )
          .done(function( data ) {
            console.log(data)
        });

    });


$('#m_ventas').addClass('active');

</script>
@endsection
