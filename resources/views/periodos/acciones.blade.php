<div class="btn-group btn-group-sm" role="group" aria-label="...">
	
	@if($per->estado)
		<button type="button" class="btn btn-outline-dark" data-url="{{ route('finalizarAutoridad',$per->id) }}" onclick="eliminar(this);">Finalizar</button>
	@endif

	<button type="button" class="btn btn-outline-danger" onclick="eliminar(this);" data-url="{{ route('eliminarAutoridad',$per->id) }}">Eliminar</button>
	
</div>
