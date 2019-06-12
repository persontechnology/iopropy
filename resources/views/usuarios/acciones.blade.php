<div class="btn-group btn-group-sm float-right" role="group" aria-label="...">
    @can('editar', $user)
    <a class="btn btn-info" href="{{ route('editarUsuario',$user->id) }}" data-toggle="tooltip" data-placement="right" title="Editar">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{ route('misPropiedades',$user->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Propiedades actuales">
        <i class="fas fa-globe-americas"></i>
    </a>
    <button type="button" class="btn btn-danger" data-url="{{ route('eliminarUsuario',$user->id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="top" title="Eliminar">
        <i class="fas fa-trash-alt"></i>
    </button>
    @endcan
</div>