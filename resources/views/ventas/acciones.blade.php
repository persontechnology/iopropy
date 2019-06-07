<div class="btn-group btn-group-sm" role="group" aria-label="...">
    <a href="{{ route('infoVenta',$venta->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Información">
        <i class="fas fa-question"></i>
    </a>
    @switch($venta->estado)
        @case('Ingresado')
            <button type="button" onclick="confirmar(this);" data-url="{{ route('anularVenta',$venta->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Anular venta">
                <i class="fas fa-ban"></i>
            </button>
            <button type="button" onclick="confirmar(this);" data-url="{{ route('aprobarVenta',$venta->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Aprobar venta">
                <i class="fas fa-check-circle"></i>
            </button>
            @break
        @case('Vendido')
            ver informacion
            @break
    @endswitch
    

</div>
