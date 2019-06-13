@extends('layouts.app',['title'=>'Autoridades'])
@section('breadcrumbs', Breadcrumbs::render('editarNoticia',$n)) 
@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('noticiasAdmin') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        Cancelar
    </a>
</div>
@endsection


@section('content')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<style>
    #map {
        height: 100vh;
    }
</style>

<div class="card">

    <form action="{{ route('actualizarNoticia') }}" method="post" enctype="multipart/form-data">
       
        <div class="card-body">
            @csrf
           <input type="hidden" name="id" value="{{ $n->id }}">
            <div class="row">
                <div class="col-md-6">
                    <fieldset>
                        <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Complete la información de la noticia</legend>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="titulo">Título:<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" id="codigo" placeholder="Ingrese.." required="" value="{{ old('titulo',$n->titulo) }}">
                                @if ($errors->has('titulo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="propiedad">Selecione propiedad para oferta de venta:</label>
                                <select class="selectpicker show-tick form-control" name="propiedad"  data-live-search="true" title="Selecione..." data-header="Selecione ">
                                    
                                    @foreach($propiedades as $pact)
                                        <option value="">Sin propiedad</option>
                                        <option value="{{ $pact->id }}" data-tokens="{{ $pact->codigo }}" data-subtext="{{ $pact->precioEstimado }}" {{ old('propiedad',$n->propiedad->id??'')==$pact->id ? 'selected':'' }}>{{ $pact->codigo }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            
                       
    
                    </fieldset>
                </div>
    
                <div class="col-md-6">
                    
                    <fieldset>
                        @if($n->imagen)
                            <a href="{{ Storage::url('public/noticias/'.$n->imagen) }}">
                                <img src="{{ Storage::url('public/noticias/'.$n->imagen) }}" alt="" class="img-fluid" width="50px;" height="50px;">
                            </a>
                            <br>
                            <br>
                        @endif
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" id="customFile" name="foto">
                                <label class="custom-file-label" for="customFile">FOTO</label>
                                    @if ($errors->has('foto'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                    </fieldset>
                    
                </div>
            </div>
    
            <div class="row">
                <div class="col">
                    <label for="detalle">Detalle</label>
                    <textarea name="detalle" id="detalle">{{ old('detalle',$n->detalle) }}</textarea>
                </div>
            </div>
           
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary mt-2 btn-lg">{{__('Actualizar')}} <i class="icon-paperplane ml-2"></i></button>
        </div>
    </form>

</div>


<script>
	$('#m_noticia').addClass('active');
        
    CKEDITOR.replace( 'detalle' );
    
</script>


@endsection
