<div class="btn-group btn-group-sm" role="group" aria-label="...">
    <a href="{{ route('infoVenta',$venta->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Información">
        <i class="fas fa-question"></i>
    </a>
    <a href="{{ route('imprimirVenta',$venta->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Imprimir">
        <i class="fas fa-print"></i>
    </a>
    <a href="{{ route('pdfVenta',$venta->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Descargar PDF">
        <i class="fas fa-file-pdf"></i>
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
        @case('Anulado')
            <button type="button" onclick="confirmar(this);" data-url="{{ route('eliminarVenta',$venta->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar venta">
                <i class="fas fa-trash-alt"></i>
            </button>
            @break
        @case('Vendido')
            <a href="{{ route('contratoVenta',$venta->id) }}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Contrato de compra y venta">
                <i class="fas fa-file-word"></i>
            </a>
            <a href="{{ route('archivos',$venta->id) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Archivos de respaldo">
                <i class="fas fa-server"></i>
            </a>
            @break
    @endswitch
    

</div>
