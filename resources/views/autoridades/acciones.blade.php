<div class="btn-group btn-group-sm float-right" role="group" aria-label="...">
  <a class="btn btn-info" href="{{ route('editarAutoridad',$user->id) }}" data-toggle="tooltip" data-placement="right" title="Editar">
      <i class="fas fa-edit"></i>
  </a>
  
  <button type="button" class="btn btn-danger" data-url="{{ route('eliminarAutoridadInfo',$user->id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="top" title="Eliminar">
      <i class="fas fa-trash-alt"></i>
  </button>
</div>