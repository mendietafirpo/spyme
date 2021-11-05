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
     <div class="text-green-500 font-bold text-lg w-3/4 ml-2">{{ $title }}</div>

     <table class="bg-gray-300 px-2 mx-2 my-2">
            <form class="navbar-form navbar-left" role="Search">
            <tr>
                <td>
                <select id="evento" required  name="evento" type="text" title="selec evento" class="bg-blue-100 form-multiselect text-black-400 rounded-lg h-9 mx-2 w-36 border-blue-500">
                    <option></option>
                    <option value="presentacionIdeaProy">Proyectos presentados</option>
                    <option value="consultaAgenteFinan">Análisis Sujeto Credito</option>
                    <option id="ver" value="remisionOrganismo">Remitidos CFI</option>
                    <option value="resolucionElegibilidad">Resolución CFI</option>
                    <option value="efectivizacion">Efectivizados</option>
                    <option value="fechaDadoDeBaja">Dados de baja</option>
                    <option value="fechaDesistido">Desistidos</option>
                    </select>
                </td>
                <td>
                    <input title="fecha desde" class="bg-blue-100 text-black-400 rounded-lg h-9 w-40 border-blue-500 mx-2" type="date" name="fechadesde" class="form-control" required>
                </td>

                <td>
                    <input title="fecha hasta" class="bg-blue-100 text-black-400 rounded-lg h-9 w-40 border-blue-500 mx-2" type="date" name="fechahasta" class="form-control" required>
                </td>

                <td>
                    <select id="opeatoria" name="operatoria" type="text" title="seleccione una opeatoria" class="bg-blue-100 form-multiselect text-black-400 rounded-lg h-9 mx-2 w-36 border-blue-500">
                    <option disabled selected>Select operat</option>
                    @foreach($selectop as $operatoriaPrograma => $op)
                        <option value="{{ $op }}" }}>{{ $op }}</option>
                    @endforeach
                    </select>
                </td>

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
            </tr>
            <tr>
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
    <div class="container rounded-md shadow-md overflow-auto bg-gray-200 lg:max-w-4xl sm:max-w-full mx-2 my-2 px-2">
        <form class="form-horizontal mx-2" name="resumen01" action="" method="PUT">
            <!--titulo 1-->
            <div class="space-x-14 ml-48">
                <div class="inline-block mt-4">
                    <label class="control-label">Proyectos</label>
                </div>
                <div class="inline-block mt-4">
                    <label class="control-label">Montos</label>
                </div>
            </div>
            <!--fila 1-->
            <div class="space-x-4">
                <div class="inline-block mt-4">
                    <label class="control-label">{{ $evento }} </label>
                </div>
                <div class="inline-block mt-4">
                    <input id="f1c1" name="f1c1" value="{{ $cant }}" class="form-control rounded-md bg-white border-gray-300 w-28 h-8 px-2" readonly/>
                </div>
                <div class="inline-block mt-4">
                    <input id="f1c2" name="f1c2" value="{{ number_format($summ, 0, ',', '.') }}" class="form-control rounded-md bg-white border-gray-300 w-44 h-8 px-2" readonly/>
                </div>
            </div>
        </form>

            <table class="table table-condensed mx-2 my-2">
                <tr class="bg-blue-200">
                    <th>Nro</th>
                    <th>Razon Social</th>
                    <th>Ciudad</th>
                    <th>Monto</th>
                    <th>CiiuG</th>
                <div class="ver"></div>
                </tr>
                @foreach ($lista as $list)
                <tr @if ($loop->even) class="bg-gray-200" @endif>
                    <td>{{ ++$i }}</td>
                    <td>{{ $list->razonSocial }}</td>
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
