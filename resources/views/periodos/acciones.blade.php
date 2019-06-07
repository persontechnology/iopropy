<div class="btn-group btn-group-sm" role="group" aria-label="...">
	
	@if($per->estado)
		<button type="button" class="btn btn-dark" data-url="{{ route('finalizarAutoridad',$per->id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="left" title="Finalizar">
			<i class="fas fa-stop-circle"></i>
		</button>
	@endif

	<button type="button" class="btn btn-danger" onclick="eliminar(this);" data-url="{{ route('eliminarAutoridad',$per->id) }}" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
		<i class="fas fa-trash-alt"></i>
	</button>
	
</div>
