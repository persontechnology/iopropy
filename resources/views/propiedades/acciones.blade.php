<div class="btn-group btn-group-sm" role="group" aria-label="...">
    <a href="{{ route('editarPropiedad',$pro->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Editar">
        <i class="fas fa-edit"></i>
    </a>
    
    <a href="{{ route('informacionPropiedad',$pro->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Información">
            <i class="fas fa-question"></i>
    </a>
    
</div>
