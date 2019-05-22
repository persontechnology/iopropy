<div class="btn-group btn-group-sm float-right" role="group" aria-label="...">
  <a class="btn btn-outline-dark" href="{{ route('editarAutoridad',$user->id) }}">Editar</a>
  
  <button type="button" class="btn btn-outline-dark" data-url="{{ route('eliminarAutoridadInfo',$user->id) }}" onclick="eliminar(this);">Eliminar</button>
</div>