<head>
@include('layouts.head')
@include('flash-message')
</head>
<body>
@include('layouts.main')

<div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2">
    <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
            Ingresar nuevo proyecto
    </div>
    <div class="flex justify-end py-2 px-2">
        <a class="btn btn-primary pull-left" href="{{ url('/pymes/mysmes') }}">Volver</a>
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

<form action="{{ route('proyectos.store') }}" method="POST">
<div class="container lg:max-w-4xl sm:max-w-full mx-2 my-2 px-2 bg-gray-300 rounded-sm shadow-md overflow-auto">
        @csrf
    <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-4 gap-x-3">
                <!-- idFirma -->
        <div class="form-group h-14">
            <strong>Id Proy: </strong>
            <input name="idProy" value="{{ $idLast }}" class="form-control" readonly required >
        </div>
        <!-- fecha de referencia -->
        <div class="form-group h-14">
            <strong>Fecha de referencia:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="fechaReferencia" autofocus>
        </div>
        <!-- nom proy -->
        <div class="form-group h-14">
            <strong>Nombre proyecto:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="text" name="nombreProyecto" required autofocus>
        </div>
        <!-- bienes q prod -->
        <div class="form-group h-22">
            <strong>Bienes que produce:</strong>
            <textarea class="bg-white rounded-sm h-22 w-full border-blue-300 px-1" name="bienesQueProduce" autofocus></textarea>
        </div>
        <!-- gtias  -->
        <div class="form-group h-14">
            <strong>Garantias Ofrecidas:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="garantiasOfrecidas" autofocus>
        </div>
        <!-- tasacion  -->
        <div class="form-group h-14">
            <strong>Tasacion:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="tasacion" autofocus>
        </div>
        <!-- nroPartida -->
        <div class="form-group h-14">
            <strong>nroPartida:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="nroPartida" autofocus>
        </div>
        <!-- nroMatricula -->
        <div class="form-group h-14">
            <strong>nroMatricula:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="nroMatricula" autofocus>
        </div>
    </div>
    <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-2 gap-x-3">
        <!-- destinoFondos -->
        <div class="form-group h-32">
            <strong>Destino de Fondos:</strong>
            <textarea class="bg-white rounded-sm h-28 w-full border-blue-300 px-1" name="destinoFondos" required  autofocus></textarea>
        </div>
        <!-- descripcionProyecto -->
        <div class="form-group h-32">
            <strong>Descripcion Proyecto:</strong>
            <textarea class="bg-white rounded-sm h-28 w-full border-blue-300 px-1" name="descripcionProyecto" autofocus></textarea>
        </div>
        <!-- antecentes -->
        <div class="form-group h-32">
            <strong>Antecentes:</strong>
            <textarea class="bg-white rounded-sm h-28 w-full border-blue-300 px-1" name="antecentes" autofocus></textarea>
        </div>
        <!-- justificacion -->
        <div class="form-group h-32">
            <strong>Justificacion:</strong>
            <textarea class="bg-white rounded-sm h-28 w-full border-blue-300 px-1" name="justificacion" autofocus></textarea>
        </div>
    </div>
    <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-6 gap-x-3">
        <!-- montoActFijo -->
        <div class="form-group h-14">
            <strong>Monto Act Fijo:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1"  type="number" step="0,1" name="montoActFijo" autofocus>
        </div>
        <!-- montoCapTrab -->
        <div class="form-group h-14">
            <strong>Monto Cap Trab:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1"  type="number" step="0.1" name="montoCapTrab" autofocus>
        </div>
        <!-- montoTotal -->
        <div class="form-group h-14">
            <strong>Monto Total:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1"  type="number" step="0.1" name="montoTotal" required autofocus>
        </div>
        <!-- inversionTotal -->
        <div class="form-group h-14">
            <strong>Inversion Total:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1"  type="number" step="0.1" name="inversionTotal" required autofocus>
        </div>
        <!-- ciiuCs -->
        <div class="form-group h-14">
        <strong>Código CIIU</strong>
            <select name="ciiuCs" id="ciiuCs" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($dfciiu as $ciiuCs => $ciiu)
                <option value="{{ $ciiuCs }}" {{ (old("ciiuCs") == $ciiu ? "selected":"") }}>{{ $ciiu }}</option>
            @endforeach
            </select>
            @error('ciiuCs')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <!-- personalOcupado -->
        <div class="form-group h-14">
            <strong>Personal Ocupado:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1"  type="number" name="personalOcupado" autofocus>
        </div>
        <!-- tipo Moneda -->
        <div class="form-group h-14">
        <strong>Tipo de Moneda</strong>
            <select name="moneda" id="moneda" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($dfmoney as $id => $mon)
                <option value="{{ $id }}" {{ (old("moneda") == $mon ? "selected":"") }}>{{ $mon }}</option>
            @endforeach
            </select>
            @error('moneda')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <!-- tipo de Cambio -->
        <div class="form-group h-14">
            <strong>Tipo de Cambio:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1"  type="number" step="0,01 name="tipodeCambio" required autofocus>
        </div>
    </div>
        <div class="pull-right py-2 px-2">
            <button type="submit" class="btn btn-success">Cargar</button>
        </div>
</div>
</form>
</body>


