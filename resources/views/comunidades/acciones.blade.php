 <div class="btn-group btn-group-justified">
	<a href="{{ route('editarComunidad',$id) }}" class="btn bg-indigo-800 btn-sm">Editar</a>
	<button type="button" class="btn bg-violet-800 btn-sm" data-url="{{ route('eliminarComunidad',$id) }}" onclick="eliminar(this);">Eliminar</button>
	
</div>