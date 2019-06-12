<div class="btn-group btn-group-sm" role="group" aria-label="...">
    <a href="{{ route('editarPropiedadFed',$pro->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Editar">
        <i class="fas fa-edit"></i>
    </a>
    
    <a href="{{ route('informacionPropiedadFed',$pro->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Información">
            <i class="fas fa-question"></i>
    </a>

    <a href="{{ route('ventasEnPropiedad',$pro->id) }}" class="btn btn-dark" data-toggle="tooltip" data-placement="left" title="Ventas">
        <i class="fas fa-shopping-cart"></i>
    </a>
    
</div>
    