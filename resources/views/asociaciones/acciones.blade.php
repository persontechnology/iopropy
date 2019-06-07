<div class="btn-group btn-group-sm" role="group" aria-label="...">
	<a href="{{ route('editarAsociacion',$id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Editar">
		<i class="fas fa-edit"></i>
	</a>
	<a href="{{ route('autoridadesAsociacion',$id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Autoridades">
		<i class="fas fa-users-cog"></i>
	</a>
	<button type="button" class="btn btn-danger" data-url="{{ route('eliminarAsociacion',$id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
		<i class="fas fa-trash-alt"></i>
	</button>
</div>