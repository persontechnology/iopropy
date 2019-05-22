
@if($aso->comunidades->count()>0)
<div class="list-group">
  @foreach($aso->comunidades as $com)
  <a href="#" class="">{{ $com->nombre }}</a>
  @endforeach
</div>
@else
<p>Sin comunidades</p>
@endif