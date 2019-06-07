@switch($venta->estado)
    @case('Ingresado')
        <span class="badge badge-pill badge-warning">Ingresado</span>
        @break
    @case('Anulado')
        <span class="badge badge-pill badge-danger">Anulado</span>
        @break
    @case('Vendido')
        <span class="badge badge-pill badge-success">Vendido</span>
        @break
        
@endswitch