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
@if(Session::has('jsAlert'))


    @if(session('info'))
    {{ session('info') }}
    @endif


@endif
@include('layouts.main')
     <!--Query scope-->
     <div class="text-green-500 font-bold text-lg w-4/5 ml-2">{{ $title }}</div>

     <table class="bg-gray-300 px-2 mx-2 my-2">
            <form class="navbar-form navbar-left" role="Search">
            <tr>
                <td>
                <select id="evento" required  name="evento" type="text" title="selec evento" class="bg-blue-100 form-multiselect text-black-400 rounded-lg h-9 mx-2 w-36 border-blue-500">
                    <option></option>
                    <option value="1">Carpetas presentadas</option>
                    <option value="2">Dados de baja</option>
                    <option value="3">Desistidos</option>
                    <option value="4">Desembolsados</option>
                    <option value="5">En trámite de cobro</option>
                    <option value="6">En trámite CFI</option>
                    <option value="7">En trámite UOP</option>
                    <option value="8">Análisis sujeto de crédito</option>
                    </select>
                </td>
                <td>
                    <input title="inicio" class="bg-blue-100 text-black-400 rounded-lg h-9 w-40 border-blue-500 mx-2" type="date" name="inicio" class="form-control" required/>
                </td>

                <td>
                    <input title="fecha desde" class="bg-blue-100 text-black-400 rounded-lg h-9 w-40 border-blue-500 mx-2" type="date" name="fechadesde" class="form-control"/>
                </td>

                <td>
                    <input title="fecha hasta" class="bg-blue-100 text-black-400 rounded-lg h-9 w-40 border-blue-500 mx-2" type="date" name="fechahasta" class="form-control"/>
                </td>

                <td>
                    <select id="opeatoria" name="operatoria" type="text" title="seleccione una opeatoria" class="bg-blue-100 form-multiselect text-black-400 rounded-lg h-9 mx-2 w-36 border-blue-500">
                    <option disabled selected>Select operat</option>
                    @foreach($selectop as $operatoriaPrograma => $op)
                        <option value="{{ $op }}" }}>{{ $op }}</option>
                    @endforeach
                    </select>
                </td>

            </tr>
            <tr>
                <td>
                    <select id="departamento" name="departamento" type="text" title="seleccione un dpto" class="bg-blue-100 form-multiselect text-black-400 rounded-lg h-9 mx-2 w-36 border-blue-500">
                    <option disabled selected>Select dpto</option>
                    @foreach($selectdpto as $district => $dp)
                        <option value="{{ $dp }}" }}>{{ $dp }}</option>
                    @endforeach
                    </select>
                </td>
                <td>
                    <select id="sector" name="sector" type="text" title="seleccione un sector" class="bg-blue-100 form-multiselect text-black-400 rounded-lg h-9 mx-2 w-36 border-blue-500">
                    <option disabled selected>Select sector</option>
                    @foreach($dfciiu2 as $grupo => $gp)
                        <option value="{{ $grupo }}" }}>{{ $gp }}</option>
                    @endforeach
                    </select>
                </td>

                <td>
                    <button type="submit" title="BUSCAR" class="btn btn-default bg-yellow-200 ml-2 my-2">
                    FILTRAR
                    </button>
                </td>
            </tr>
            </form>
    </table>
    <!--fin Query scope-->
@if($cant)
    <div class="container rounded-md shadow-md overflow-auto bg-gray-100 lg:max-w-4xl sm:max-w-full mx-2 my-2 px-2">
        <form class="form-horizontal mx-2" name="resumen01" action="" method="PUT">
            <!--titulo 1-->
            <div class="space-x-4 ml-28">
                <div class="inline-block mt-4">
                    <label class="control-label">Proyectos</label>
                </div>
                <div class="inline-block pl-10 mt-4">
                    <label class="control-label">Montos</label>
                </div>
            </div>
            <!--fila 1-->
            <div class="space-x-4">
                <div class="inline-block mt-4">
                    <label class="control-label">Resultados </label>
                </div>
                <div class="inline-block mt-4">
                    <input id="f1c1" name="f1c1" value="{{ $cant }}" class="form-control rounded-md bg-white border-gray-300 w-28 h-8 px-2" readonly/>
                </div>
                <div class="inline-block mt-4">
                    <input id="f1c2" name="f1c2" value="{{ number_format($summ, 0, ',', '.') }}" class="form-control rounded-md bg-white border-gray-300 w-44 h-8 px-2" readonly/>
                </div>
            </div>
        </form>

            <table class="table w-full table-condensed mx-2 my-2">
                <tr class="bg-blue-200">
                    <th>Nro</th>
                    <th>Razon Social</th>
                    <th>Ciudad</th>
                    <th>Monto</th>
                    <th>CiiuG</th>
                    <th>Fecha presen</th>
                    @if($evento==2)
                        <th>Fecha dado baja</th>
                    @elseif($evento==3)
                        <th>Fecha desistido</th>
                    @elseif($evento==4)
                        <th>Desembolsado</th>
                    @elseif($evento==5)
                        <th>Resolucion</th>
                    @elseif($evento==6)
                        <th>Remisión CFI</th>
                    @elseif($evento==7)
                        <th>Informe banco</th>
                    @elseif($evento==8)
                        <th>Consulta banco</th>
                    @endif
                <div class="ver"></div>
                </tr>
                @foreach ($lista as $list)
                <tr @if ($loop->even) class="bg-gray-200" @endif>
                    <td>{{ ++$i }}</td>
                    <td><a class="text-blue-400 underline" title="ver detalles de la firma" href="{{ route('proyectos.irproyecto',$list->idFirma) }}">{{ $list->razonSocial }}</a></td>
                    <td>{{ $list->ciudad }}</td>
                    @foreach($montos as $idProy => $monto)
                        @if ($idProy == $list->proyecto_idProy)
                            <td> {{ number_format($monto, 0, ',', '.') }} </td>
                        @endif
                    @endforeach
                    @foreach($ciius as $idProy => $ciiu)
                        @if ($idProy == $list->proyecto_idProy)
                            <td> {{ $ciiu }} </td>
                        @endif
                    @endforeach

                    <td>{{ Carbon::parse($list->consultaAgenteFinan)->format('d/m/Y') }}</td>
                    @if($evento==2)
                        <td>{{ Carbon::parse($list->fechaDadoDeBaja)->format('d/m/Y') }}</td>
                    @elseif($evento==3)
                        <td>{{ Carbon::parse($list->fechaDesistido)->format('d/m/Y') }}</td>
                    @elseif($evento==4)
                        <td>{{ Carbon::parse($list->efectivizado)->format('d/m/Y') }}</td>
                    @elseif($evento==5)
                        <td>{{ Carbon::parse($list->resolucionElegibilidad)->format('d/m/Y') }}</td>
                    @elseif($evento==6)
                        <td>{{ Carbon::parse($list->remisionOrganismo)->format('d/m/Y') }}</td>
                    @elseif($evento==7)
                        <td>{{ Carbon::parse($list->informeSujetoCredito)->format('d/m/Y') }}</td>
                    @elseif($evento==8)
                        <td>{{ Carbon::parse($list->consultaAgenteFinan)->format('d/m/Y') }}</td>
                    @endif
                @endforeach
                </tr>
            </table>
@endif
    </div>
   {{ $lista-> withQueryString() -> links() }}
</body>

<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
