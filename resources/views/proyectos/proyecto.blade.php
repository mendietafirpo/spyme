<?php
use Carbon\Carbon;
?>

<head>
@include('layouts.head')
@include('flash-message')
</head>
<header>
@include('layouts.header')
</header>

<body>
@include('layouts.main')
    <td> &nbsp</td>
     <table class="bg-green-100 w-11/12">
            <form class="navbar-form navbar-left" role="Search">
                <td>
                <a class="btn btn-warning ml-16 pull-left" href="{{ route('pymes.cargaproyecto') }}"> Nuevo proyecto</a>
                &nbsp
                &nbsp
                <a href="javascript: history.go({{ $go }})" class="btn btn-primary pull-right"> Volver</a>
                </td>
            </tr>
            </form>
    </table>

    <td> &nbsp</td>
    <table class="table table-condensed w-11/12 mx-2">
        <tr class="bg-blue-200">
            <th>Fecha referencia</th>
            <th>Nombre proyecto</th>
            <th>Destino</th>
            <th>Monto</th>
            <th width="280px">Acción</th>
        </tr>
        @foreach ($proyectos as $proyecto)
        <tr @if ($loop->even) class="bg-gray-200" @endif>
            @if($proyecto->fechaReferencia)
            <td> <a class="text-blue-400 underline" title="gestión del trámite" href="{{ route('gestiones.irgestion',$proyecto->idProy) }}">{{ Carbon::parse($proyecto->fechaReferencia)->format('d/m/Y') }}</a></td>
            @else
            <td></td>
            @endif
            <td> <a class="text-blue-400 underline" title="ver detalles/información del proyecto" href="{{ route('proyectos.show',$proyecto->idProy) }}">{{ $proyecto->nombreProyecto }}</a></td>
            <td>{{ $proyecto->destinoFondos }}</td>
            <td>{{ number_format($proyecto->montoTotal, 0, ',', '.') }}</td>
            <td>
                <form action="{{ route('proyectos.show',$proyecto->idProy) }}" method="POST">

                    <a class="btn btn-info" title="presupuesto de inversión" href="{{ route('presupuestos.irpresup',$proyecto->idProy) }}">Presup</a>
                    <a class="btn btn-success" title="info del trámite" href="{{ route('tramites.irtramite',$proyecto->idProy) }}"> Tramite</a>
                    <a class="btn btn-success" title="info del expediente" href="{{ route('expedientes.irexpte',$proyecto->idProy) }}"> Expte</a>

                <!--    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>-->
                </form>
            </td>
            </tr>
        @endforeach
    </table>
</body>
<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
