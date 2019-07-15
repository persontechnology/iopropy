@extends('layouts.app',['title'=>'Contrato de compra venta'])

@section('breadcrumbs')
    {{ Breadcrumbs::render('infoVenta',$venta) }}
@endsection

@section('acciones')

<div class="breadcrumb justify-content-center">
  <a href="{{ route('ventas') }}" class="breadcrumb-elements-item">
      <i class="fas fa-arrow-left"></i>
      Cancelar
  </a>
</div>
@endsection


@section('content')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<form action="{{ route('actualizarContrato') }}" method="post">
    @csrf
<input type="hidden" name="id" value="{{ old('id',$venta->id) }}">
 <div class="card h-100">
    <div class="card-header">
        <button type="submit" class="btn btn-lg btn-success">
                <i class="fas fa-save"></i> Actualizar contrato
        </button>
        <a href="{{ route('contratoPdf',$venta->id) }}" class="btn btn-lg btn-warning">
            <i class="fas fa-file-pdf"></i> Descargar PDF
        </a>
       
    </div>

    <div class="card-body h-100" class="text-justify">
    
        @if($venta->contrato)
        <textarea name="contrato" class="textarea h-100">
            {!! $venta->contrato !!}</textarea>
        @else
        <textarea name="contrato">
            <h3 style="text-align:center"><span style="color:#663300">FEDERACI&Oacute;N INTERPROVINCIAL DE CENTROS SHUAR &quot;FICSH&quot;</span></h3>
             <h1 style="text-align:center"><b>CONTRATO DE COMPRA VENTA </b></h1>
             <p style="text-align: right">N: <b>{{ $venta->numero }}</b>  </p>
            <p style="text-align:justify">
                En la cuidad de <b>{{ $venta->propiedad->comunidad->parroquia->nombre }}</b>, hoy <b>{{ $venta->created_at }}</b>, comparecen ante mí <b>{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</b> ,
                Presidente de la Federación Interprovincial / de Centros Shuar-Ficsh, por una parte el/los señor/res   
                <b>@foreach($venta->propietariosAntiguos as $proAn) {{ $proAn->nombres }} {{ $proAn->apellidos }}, @endforeach</b>
                 a quien para efectos del presente instrumento se le denominará el <b>VENDEDOR/ES</b>, 
                 y por otra parte el/los señor/es <b>@foreach ($venta->propietariosActuales as $proAc) {{ $proAc->nombres }} {{ $proAc->apellidos }}, @endforeach</b> 
                 quien comparece por medio de su apoderada  <b>(......)</b>   a quien para efectos del presente instrumento se le denominará como <b> COMPRADOR/ES</b>. Los comparecientes son mayores de edad, Ecuatorianos, solteros, de ocupación estudiante y  quehaceres domésticos, respectivamente, 
                 domiciliados en el <b>{{ $venta->propiedad->comunidad->nombre }}</b>, de la Asociación <b>{{ $venta->propiedad->comunidad->asociacion->nombre }}</b>, 
                 parroquia <b>{{ $venta->propiedad->comunidad->parroquia->nombre }}</b>, Cantón <b>{{ $venta->propiedad->comunidad->parroquia->canton->nombre }}</b>, 
                 Provincia de <b>{{ $venta->propiedad->comunidad->parroquia->canton->provincia->    nombre }}</b>, filiales a la Federación Interprovincial de Centros Shuar, legalmente capaces para obligarse y contratar. Quienes libre y voluntariamente convienen en celebrar el presente contrato de Compra­ venta, al tener de las siguientes cláusulas.
            </p>
            <h3><b>PRIMERA.- ANTECEDENTES:</b> </h3>
            <p style="text-align:justify">
                El señor/es <b> @foreach ($venta->propietariosActuales as $propAct) {{ $propAct->nombres }} {{ $propAct->apellidos }}, @endforeach </b> es propietario de un lote de terreno de <b>{{ $venta->medidaTotal }}</b> ubicado en <b>{{ $venta->propiedad->comunidad->nombre }}</b>, 
                de la Asociación <b>{{ $venta->propiedad->comunidad->asociacion->nombre }}</b>, parroquia <b>{{ $venta->propiedad->comunidad->parroquia->nombre }}</b>, Cantón <b>{{ $venta->propiedad->comunidad->parroquia->canton->nombre }}</b>. Provincia de <b>{{ $venta->propiedad->comunidad->parroquia->canton->provincia->nombre }}</b>, filial a la Federación Interprovincial de Centros Shuar, 
                cuyos límites son los siguientes; NORTE, con la propiedad de <b>{{ $venta->norte }}</b>, SUR; con propiedad de <b>{{ $venta->sur }}</b>; ESTE; con propiedad de <b>{{ $venta->este }}</b>, OESTE, con propiedad de <b>{{ $venta->oeste }}</b>. Dicho predio lo adquirió mediante un contrato de compra venta al señor/es 
                <b> @foreach($venta->propietariosIniciales as $propIni) {{ $propIni->nombres }} {{ $propIni->apellidos }}, @endforeach </b> celebrada ante el señor <b>(.........)</b> síndico del Centro Shuar con fecha <b>(día/mes/año)</b>.
            </p>
            <h3><b>SEGUNDA.- ENAJENACION:</b>  </h3>
            <p style="text-align:justify">
               Con los antecedentes expuestos, el señor/es  <b> @foreach ($venta->propietariosAntiguos as $proAnti) {{ $proAnti->nombres }} {{ $proAnti->apellidos }}, @endforeach </b> da en enajenación el lote de terreno de <b>{{ $venta->medidaTotal }}</b> con las limitaciones descritas en términos precedentes a favor de/los señor/es <b> @foreach ($venta->propietariosActuales as $propActua) {{ $propActua->nombres }} {{ $propActua->apellidos }}, @endforeach </b>, quien comparece por medio de su apoderada <b>(......)</b> con todas sus entradas y salidas, usos, costumbres, servidumbres activas y pasivas, libre de todo gravamen a entera satisfacción del comprador, quedando sujeto el vendedor al saneamiento por evicción de conformidad con la ley, sin reservar para sí, parte o derecho alguno sobre el mismo.
            </p>
            <h3><b>TERCERA.- PRECIO: </b></h3>
            <p style="text-align:justify">
                El precio por el cual celebran este contrato de compra venta del lote de terreno es de , <b>($ {{ $venta->precio }})</b> pagados en efectivo y/o en moneda de curso legal, del cual el vendedor declara haber recibido sin inconveniencia alguna, sin tener nada que redamar en lo posterior.
            </p>
            <h3><b>CUARTA: GASTO.-</b></h3>
            <p style="text-align:justify">
                Los gastos que ocasione el presente instrumento, correrá por cuenta del comprador.
            </p>
            <h3><b>OCTAVA: ACEPTACIÓN.- </b></h3>
            <p style="text-align:justify">
                Leída que fue el presente instrumento, las partes se ratifican en todas y cada una delas cláusulas
            </p>
            <h3><b>NOVENA: </b></h3>
            <p style="text-align:justify">
                El lote de terreno por pertenecer al territorio global de la Federación Interprovincial de Centros Shuar, no es susceptible de proceder a protocolizar para la obtención de escritura pública
            </p>
            <h3><b>NOVENO.- JURISOICCION Y COMPETENCIA:</b></h3>
            <p style="text-align:justify">
                En caso de controversia entre las partes, se sujetarán a la jurisdicción de la Comunidad en primera instancia, en segunda ante la Asociación respectiva y en tercera y última instancia conocerá la Federación Interprovincial de Centros Shuar- Ficsh. Hasta aquí el presente contrato de compra venta,  ratificada por las partes en todo su contenido firmando conmigo <b>{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</b> en tres originales del cual doy fe, hoy <b> {{ $venta->created_at }}</b>.
            </p>
            
            <h3>Firman:</h3>
            <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:100%">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><strong>Vendedores</strong></td>
                            <td style="text-align:center"><strong>Compradores</strong></td>
                        </tr>
                        <tr>
                            <td style="text-align:center">
                                
                                @foreach ($venta->propietariosAntiguos as $proAntiFirma)
                                    <br>
                                    <p>_____________________</p>
                        
                                    <p><strong>{{ $proAnti->nombres }} {{ $proAnti->apellidos }}</strong></p>
                        
                                    <p>{{ $proAnti->identificacion }} </p>
                                @endforeach
                            
                            </td>

                            <td style="text-align:center">
                                @foreach ($venta->propietariosActuales as $proActuFirma)
                                    <br>
                                    <p>_____________________</p>
                        
                                    <p><strong>{{ $proActuFirma->nombres }} {{ $proActuFirma->apellidos }}</strong></p>
                        
                                    <p>{{ $proActuFirma->identificacion }} </p>
                                @endforeach

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <p style="text-align:center">&nbsp;</p>
                
                            <p style="text-align:center">_____________________________________________</p>
                
                            <p style="text-align:center">
                                {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}
                            </p>
                
                            <p style="text-align:center">
                                    {{ Auth::user()->identificacion }}
                            </p>
                
                            <p style="text-align:center"><strong>PRESIDENTE DE LA FEDERACI&Oacute;N INTERPROVINCIAL DE CENTROS SHUAR</strong></p>
                
                            <p style="text-align:center">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr />
                <p style="text-align:center"><span style="color:#3498db">SEDE: Domingo Com&iacute;n 17-38 y Victorino Abarca Telefax: N<sup>o&nbsp;</sup>(593) 072-740-108 072 42474</span></p>

                <p style="text-align:center"><span style="color:#3498db">Email: secretariaficsh@hotmail.com www.ficsh.org COORDINACI&Oacute;N: Tarqui 809 Quito-Ecuador Sucia-Morono Santiago-Ecuador&nbsp;</span></p>

        </textarea>
        @endif
    </div>
</div>
</form>


<script>
    $('#m_ventas').addClass('active');
   
    CKEDITOR.replace( 'contrato',{
        language: 'es',
        uiColor: '#9AB8F3',
    });
</script>
@endsection
