<head>
@include('layouts.head')
@include('flash-message')
</head>
<body>
@include('layouts.main')

<div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2">
    <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
            Ingresar nueva persona
    </div>
    <div class="flex justify-end py-2 px-2">
        <a href="javascript: history.go(-1)" class="btn btn-primary"> Volver</a>
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

<form action="{{ route('personas.store') }}" method="POST">
<div class="container lg:max-w-4xl sm:max-w-full mx-2 my-2 px-2 bg-gray-300 rounded-sm shadow-md overflow-auto">
        @csrf
    <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-6 gap-x-3">
                <!-- idpersona -->
        <div class="form-group h-14">
            <strong>Id Pers: </strong>
            <input name="idPers" value="{{ $idLast }}" class="form-control" readonly required >
        </div>

        <!-- dni -->
        <div class="form-group h-14">
            <strong>Documento Identidad:</strong>
            <input minlength="8" maxlength="9" class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="text" name="documentoIdentidad" required autofocus>
        </div>
        <!-- apellido y nombres -->
        <div class="form-group h-14">
            <strong>Apellido y nombres:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="nombresApellido" required autofocus>
        </div>
        <!-- direccion legal -->
        <div class="form-group h-14">
            <strong>Direccion particular:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="direcionParticular" autofocus>
        </div>
        <!-- estado civil -->
        <div class="form-group h-14">
        <strong>Estado civil</strong>
            <select name="estadoCivil" id="estadoCivil" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($dfeciv as $id => $ec)
                <option value="{{ $id }}" {{ (old("estadoCivil") == $ec ? "selected":"") }}>{{ $ec }}</option>
            @endforeach
            </select>
            @error('estadoCivil')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <!-- estudios cursados -->
        <div class="form-group h-14">
        <strong>Estudios Cursados</strong>
                <select name="estudiosCursados" value="" id="estudiosCursados" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                <option value=""></option>
                @foreach($dfecurs as $id => $ecu)
                    <option value="{{ $id }}" {{ (old("estudiosCursados") == $ecu ? "selected":"") }}>{{ $ecu }}</option>
                @endforeach
                </select>
                @error('situacionAfip')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
        </div>
        <!-- fecha de nacimiento -->
        <div class="form-group h-14">
            <strong>Fecha de Nacimiento:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" type="date" name="fechaNacimiento" required autofocus>
        </div>
        <!-- nacionalidad -->
        <div class="form-group h-14">
            <strong>Nacionalidad:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="nacionalidad" required autofocus>
        </div>
        <!-- dedicacion -->
        <div class="form-group h-14">
            <strong>Dedicacion:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="dedicacion" required autofocus>
        </div>
        <!-- ciudad -->
        <div class="form-group h-14">
            <strong>Ciudad:</strong>
            <select name="ciudad" id="ciudad" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                <option value=""></option>
                @foreach($cities as $ciudad => $op)
                    <option value="{{ $op }}" {{ (old("ciudad") == $op ? "selected":"") }}>{{ $op }}</option>
                @endforeach
                </select>
        </div>
        <!-- departamento -->
        <div class="form-group h-14">
            <strong>Departamento:</strong>
            <select name="distrito" id="distrito" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                <option value=""></option>
                @foreach($districts as $distrito => $op)
                    <option value="{{ $op }}" {{ (old("distrito") == $op ? "selected":"") }}>{{ $op }}</option>
                @endforeach
                </select>
        </div>
        <!-- provincia -->
        <div class="form-group h-14">
            <strong>Provincia:</strong>
            <select name="estado" id="estado" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                <option value=""></option>
                @foreach($states as $estado => $op)
                    <option value="{{ $op }}" {{ (old("estado") == $op ? "selected":"") }}>{{ $op }}</option>
                @endforeach
                </select>

        </div>
        <!-- pais -->
        <div class="form-group h-14">
            <strong>País:</strong>
            <select name="pais" id="pais" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                <option value=""></option>
                @foreach($countries as $pais => $op)
                    <option value="{{ $op }}" {{ (old("pais") == $op ? "selected":"") }}>{{ $op }}</option>
                @endforeach
                </select>
        </div>
        <!-- telefono -->
        <div class="form-group h-14">
            <strong>Telefono:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="telefono" autofocus>
        </div>
        <!-- telefono 2 -->
        <div class="form-group h-14">
            <strong>Telefono altern:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="telefono_op" autofocus>
        </div>
        <!-- email -->
        <div class="form-group h-14">
            <strong>email:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="email" required autofocus>
        </div>
        <!-- email 2 -->
        <div class="form-group h-14">
            <strong>email altern:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-blue-300 px-1" name="email_op" autofocus>
        </div>
        <!-- estado civil -->
        <div class="form-group h-14">
        <strong>Tipo Relación empresarial</strong>
            <select name="tipoRelacion" id="tipoRelacion" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($fprel as $id => $fp)
                <option value="{{ $id }}" {{ (old("tipoRelacion") == $fp ? "selected":"") }}>{{ $fp }}</option>
            @endforeach
            </select>
            @error('tipo_relacion')
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


