<head>
@include('layouts.head')
@include('flash-message')
</head>
<body>
@include('layouts.main')

<div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2">
    <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
            Ingresar nuevo trámite
    </div>
    <div class="flex justify-end py-2 px-2">
        @if (session('idFirma'))
            <a class="btn btn-primary pull-left" href="{{ url('/proyectos/proyecto/'.session('idFirma')) }}">Volver</a>
        @else
            <a href="javascript: history.go(-1)" class="btn btn-primary pull-left"> Volver</a>
        @endif
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tramites.store') }}" method="POST">
<div class="container lg:max-w-4xl sm:max-w-full mx-2 my-2 px-2 bg-gray-300 rounded-sm shadow-md overflow-auto">
        @csrf
    <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-4 gap-x-3">
                <!-- idFirma -->
        <div class="form-group h-14">
            <strong>Id: </strong>
            <input name="id" value="{{ $idLast }}" class="form-control" readonly required >
        </div>
                <!-- idFirma -->
                <div class="form-group h-14">
            <strong>Id Proy: </strong>
            <input name="idProy" value="{{ $idProy }}" class="form-control" readonly required >
        </div>
        <!-- fecha pres proy -->
        <div class="form-group h-14">
            <strong>Presentacion Idea Proy:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="presentacionIdeaProy" autofocus>
        </div>
        <!-- cons bco -->
        <div class="form-group h-14">
            <strong>Consulta Agente Finan:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="consultaAgenteFinan" autofocus>
        </div>
        <!-- info bco -->
        <div class="form-group h-14">
            <strong>Informe Sujeto Credito:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="informeSujetoCredito" autofocus>
        </div>
        <!-- sujeto de credito -->
        <div class="form-group h-14">
            <strong>Status del sujeto crédito:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="text" name="sujetoCredito" autofocus>
        </div>
        <!-- remision org -->
        <div class="form-group h-14">
            <strong>Remision Organismo:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="remisionOrganismo" autofocus>
        </div>

        <!-- aprob tec -->
        <div class="form-group h-14">
            <strong>Aprobacion Tecnica:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="aprobacionTecnica" autofocus>
        </div>
        <!-- resoluc -->
        <div class="form-group h-14">
            <strong>Resolucion Elegibilidad:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="resolucionElegibilidad" autofocus>
        </div>
        <!-- trans fon -->
        <div class="form-group h-14">
            <strong>Transferencia Fondos:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="transferenciaFondos" autofocus>
        </div>
        <!-- efect -->
        <div class="form-group h-14">
            <strong>Efectivizacion:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="efectivizacion" autofocus>
        </div>
        <!-- desis -->
        <div class="form-group h-14">
            <strong>Fecha Desistido:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="fechaDesistido" autofocus>
        </div>
        <!-- dado baja -->
        <div class="form-group h-14">
            <strong>FechaDadoDeBaja:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="fechaDadoDeBaja" autofocus>
        </div>

    </div>
        <div class="pull-right py-2 px-2">
            <button type="submit" class="btn btn-success">Cargar</button>
        </div>
</div>
</form>
</body>


