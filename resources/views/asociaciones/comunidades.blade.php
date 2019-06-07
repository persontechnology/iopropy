
@if($aso->comunidades->count()>0)
  @foreach($aso->comunidades as $com)
  <li>
      <a href="{{ route('propiedadesEnAsociaciones',$com->id) }}" class="">{{ $com->nombre }}</a>
  </li>
  
  @endforeach
@else
<p>Sin comunidades</p>
@endif