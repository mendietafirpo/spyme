<head>
@include('layouts.head')
@include('flash-message')
</head>
<body>
@include('layouts.main')

<div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2">
    <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
            Ingresar nuevo expediente
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

<form action="{{ route('expedientes.store') }}" method="POST">
<div class="container lg:max-w-4xl sm:max-w-full mx-2 my-2 px-2 bg-gray-300 rounded-sm shadow-md overflow-auto">
        @csrf
    <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-4 gap-x-3">
                <!-- id -->
        <div class="form-group h-14">
            <strong>Id: </strong>
            <input name="id" value="{{ $idLast }}" class="form-control" readonly required >
        </div>
                <!-- idProy -->
                <div class="form-group h-14">
            <strong>Id Proy: </strong>
            <input name="idProy" value="{{ $idProy }}" class="form-control" readonly required >
        </div>
        <!-- entid fuente fondos -->
        <div class="form-group h-14">
            <strong>Entidad Fuente De Fondos:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="text" value="CFI" name="entidadFuenteDeFondos" autofocus>
        </div>
        <!-- operatoriay -->
        <div class="form-group h-14">
            <strong>Operatoria Programa:</strong>
            <select name="operatoriaPrograma" id="operatoriaPrograma" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($operatoria as $operatoriaPrograma => $op)
                <option value="{{ $op }}" {{ (old("operatoriaPrograma") == $op ? "selected":"") }}>{{ $op }}</option>
            @endforeach
            </select>
            @error('operatoriaPrograma')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <!-- agente financiero -->
        <div class="form-group h-14">
            <strong>Agente Financiero:</strong>
            <select name="agenteFinanciero" id="agenteFinanciero" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($banco as $agenteFinanciero => $op)
                <option value="{{ $op }}" {{ (old("agenteFinanciero") == $op ? "selected":"") }}>{{ $op }}</option>
            @endforeach
            </select>
            @error('agenteFinanciero')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <!-- sucursal Ventanilla -->
        <div class="form-group h-14">
            <strong>Sucursal:</strong>
            <select name="sucursalVentanilla" id="sucursalVentanilla" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($sucursal as $sucursalVentanilla => $op)
                <option value="{{ $op }}" {{ (old("sucursalVentanilla") == $op ? "selected":"") }}>{{ $op }}</option>
            @endforeach
            </select>
            @error('sucursalVentanilla')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <!-- evaluador Tecnico -->
        <div class="form-group h-14">
            <strong>Evaluador Tecnico:</strong>
            <select name="evaluadorTecnico" id="evaluadorTecnico" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($tecnico as $evaluadorTecnico => $op)
                <option value="{{ $op }}" {{ (old("evaluadorTecnico") == $op ? "selected":"") }}>{{ $op }}</option>
            @endforeach
            </select>
            @error('evaluadorTecnico')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


    </div>
        <div class="pull-right py-2 px-2">
            <button type="submit" class="btn btn-success">Cargar</button>
        </div>
</div>
</form>
</body>


