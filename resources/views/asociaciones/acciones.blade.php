<div class="btn-group btn-group-sm float-right" role="group" aria-label="...">
	<a href="{{ route('editarAsociacion',$id) }}" class="btn btn-outline-info">Editar</a>
	<a href="{{ route('autoridadesAsociacion',$id) }}" class="btn btn-outline-primary">Autoridades</a>
	<button type="button" class="btn btn-outline-danger" data-url="{{ route('eliminarAsociacion',$id) }}" onclick="eliminar(this);">Eliminar</button>
</div>