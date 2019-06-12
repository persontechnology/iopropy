@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('home'))


@section('content')

@if (session('status'))
    
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
		<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
		<span class="font-weight-semibold">{{ session('status') }}</span> 
	</div>
    
@endif


<div class="card">
    <div class="card-header">
        Propiedades
    </div>
    <div class="card-body">
       <div class="table-responsive">
        {!! $dataTable->table()  !!}
       </div>
    </div>
</div>

@if(Auth::user()->hasRole('Administrador'))
<script src="{{ asset('vendor/Highcharts-7.1.2/code/highcharts.js') }}"></script>
<script src="{{ asset('vendor/Highcharts-7.1.2/code/modules/exporting.js') }}"></script>
<script src="{{ asset('vendor/Highcharts-7.1.2/code/modules/export-data.js') }}"></script>
<script>
    Highcharts.setOptions({
        lang: {
            loading: 'Cargando...',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            exportButtonTitle: "Exportar",
            printButtonTitle: "Importar",
            rangeSelectorFrom: "Desde",
            rangeSelectorTo: "Hasta",
            rangeSelectorZoom: "Período",
            downloadPNG: 'Descargar imagen PNG',
            downloadJPEG: 'Descargar imagen JPEG',
            downloadPDF: 'Descargar imagen PDF',
            downloadSVG: 'Descargar imagen SVG',
            printChart: 'Imprimir',
            resetZoom: 'Reiniciar zoom',
            resetZoomTitle: 'Reiniciar zoom',
            thousandsSep: ",",
            decimalPoint: '.'
        }
    });
</script>



<div class="card">
    <div class="card-header">Reportes</div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div id="containerUsuariosActuales"></div>
            </div>
            <div class="col-md-6">
                <div id="containerTotales"></div>
            </div>
        </div>
        
        <hr>
        <div id="containerVentasXMesesActuales"></div>
        <hr>
        <div id="containerVentasAnios"></div>
    </div>
</div>



<script>
   

    //usuarios actuales
    Highcharts.chart('containerUsuariosActuales', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Usuarios<br>actuales<br>{{ date('Y') }}',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%'],
                size: '110%'
            }
        },
        series: [{
            type: 'pie',
            name: 'Usuarios actuales',
            innerSize: '50%',
            data: [
                ['Administradores', {{ iopro\User::role('Administrador')->count() }}],
                ['Asociaciones', {{ iopro\User::role('Asociacion')->count() }}],
                ['Usuarios', {{ iopro\User::role('Usuarios')->count() }}],
            ]
        }]
    });

    //ventas por meses actuales
    Highcharts.chart('containerVentasXMesesActuales', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Total de ventas por mes'
        },
        subtitle: {
            text: 'del año {{ date('Y') }}'
        },
        xAxis: {
            categories: [
                @foreach ($ventasMesesActuales as $v)
                    '{{ $v->meses }}',
                @endforeach
            ]
        },
        yAxis: {
            title: {
                text: 'Total de ventas'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Total de ventas $',
            marker: {
                symbol: 'square'
            },
            data: [
                @foreach ($ventasMesesActuales as $v)
                    {{ $v->total }},
                @endforeach
            ]
    
        }]
    });

    //ventas por anio
    
    Highcharts.chart('containerVentasAnios', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Total de ventas por año'
        },
        xAxis: {
            categories: [
                @foreach ($ventasAnios as $vya)
                    '{{ $vya->anios }}',
                @endforeach
            ]
        },
        yAxis: {
            title: {
                text: 'Total de ventas'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Total de ventas $',
            marker: {
                symbol: 'square'
            },
            data: [
                @foreach ($ventasAnios as $vyt)
                    {{ $vyt->total }},
                @endforeach
            ]
    
        }]
    });


    //totales
    Highcharts.chart('containerTotales', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Totales'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [ 
            {
                name: 'Comunidades',
                y: {{ iopro\Models\Comunidad::count() }}
            }, {
                name: 'Asociaciones',
                y: {{ iopro\Models\Asociacion::count() }}
            },
            {
                name: 'Propiedades',
                y: {{ iopro\Models\Propiedad::count() }}
            }
            ]
        }]
    });
</script>

@endif


{!! $dataTable->scripts() !!}
<script>
    $('#m_home').addClass('active');

</script>


@endsection
