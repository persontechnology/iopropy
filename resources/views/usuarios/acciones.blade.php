<div class="btn-group btn-group-sm float-right" role="group" aria-label="...">
    @can('editar', $user)
    <a class="btn btn-outline-dark" href="{{ route('editarUsuario',$user->id) }}">Editar</a>
    <button type="button" class="btn btn-outline-dark" data-url="{{ route('eliminarUsuario',$user->id) }}" onclick="eliminar(this);">Eliminar</button>
    @endcan
</div>