<head>
@include('layouts.head')
@include('flash-message')
</head>
<body>
@include('layouts.main')

<div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2">
    <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
            Ingresar nueva firma
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

<form action="{{ route('firmas.store') }}" method="POST">
<div class="container lg:max-w-4xl sm:max-w-full mx-2 my-2 px-2 bg-gray-300 rounded-sm shadow-md overflow-auto">
        @csrf
    <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-6 gap-x-3">
        <!-- idFirma -->
        <div class="form-group h-14">
            <strong>Id Firma: </strong>
            <input name="idFirma" value="{{ $idLast }}" class="form-control" readonly required >
        </div>
        <!-- cuit -->
        <div class="form-group h-14">
            <strong>Cuit:</strong>
            <input minlength="11" maxlength="11" class="bg-white rounded-sm h-11 w-full border-gray-500" type="text" name="cuit" class="form-control" required autofocus>
        </div>
        <!-- forma juridica -->
        <div class="form-group h-14">
        <strong>Forma Jurídica</strong>
            <select name="formaJuridica" id="formaJuridica" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
            <option value=""></option>
            @foreach($dffjur as $id => $fj)
                <option value="{{ $id }}" {{ (old("formaJuridica") == $fj ? "selected":"") }}>{{ $fj }}</option>
            @endforeach
            </select>
            @error('formaJuridica')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <!-- situacion afip -->
        <div class="form-group h-14">
        <strong>Situación Afip</strong>
                <select name="situacionAfip" value="" id="situacionAfip" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                <option value=""></option>
                @foreach($dfafip as $id => $afip)
                    <option value="{{ $id }}" {{ (old("situacionAfip") == $afip ? "selected":"") }}>{{ $afip }}</option>
                @endforeach
                </select>
                @error('situacionAfip')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
        </div>
        <!-- razon social -->
        <div class="form-group h-14">
            <strong>Razón Social:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-gray-300" name="razonSocial" required autofocus>
        </div>
        <!-- direccion legal -->
        <div class="form-group h-14">
            <strong>Direccion Legal:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-gray-300" name="direcionLegal" autofocus>
        </div>
        <!-- fecha fundación -->
        <div class="form-group h-14">
            <strong>Fecha fundación:</strong>
            <input class="bg-white rounded-sm h-11 w-full border-gray-300" type="date" name="fechaFunacion" autofocus>
        </div>
            <!-- localidad -->
            <div class="form-group h-14">
                <strong>Localidad:</strong>
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
                <select name="departamento" id="departamento" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                <option value=""></option>
                @foreach($districts as $departamento => $op)
                    <option value="{{ $op }}" {{ (old("departamento") == $op ? "selected":"") }}>{{ $op }}</option>
                @endforeach
                </select>
            </div>
            <!-- provincia arg -->
            <div class="form-group h-14">
                <strong>Provincia(Arg):</strong>
                    <select class="bg-white rounded-sm h-11 w-full border-gray-300" name="provincia">
                    <option value="   "></option>
                    <option value="Buenos Aires ">BUENOS AIRES</option>
                    <option value="Catamarca">CATAMARCA</option>
                    <option value="Chaco">CHACO</option>
                    <option value="Chubut">CHUBUT</option>
                    <option value="Cordoba">CORDOBA</option>
                    <option value="Corrientes">CORRIENTES</option>
                    <option value="Entre Rios">ENTRE RIOS</option>
                    <option value="Formosa">FORMOSA</option>
                    <option value="CABA">CABA</option>
                    <option value="Jujuy">JUJUY</option>
                    <option value="La Pampa">LA PAMPA</option>
                    <option value="La Rioja">LA RIOJA</option>
                    <option value="Mendoza">MENDOZA</option>
                    <option value="Misiones">MISIONES</option>
                    <option value="Neuquen">NEUQUEN</option>
                    <option value="Rio Negro">RIO NEGRO</option>
                    <option value="Salta">SALTA</option>
                    <option value="San Juan">SAN JUAN</option>
                    <option value="San Luis">SAN LUIS</option>
                    <option value="Santa Cruz">SANTA CRUZ</option>
                    <option value="Santa Fe">SANTA FE</option>
                    <option value="Santiago del Estero">SANTIAGO DEL ESTERO</option>
                    <option value="Tierra del Fuego">TIERRA DEL FUEGO</option>
                    <option value="Tucumán">TUCUMAN</option>
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
                    <input class="bg-white rounded-sm h-11 w-full border-gray-300" type="text" name="pais" class="form-control" value="Argentina">
            </div>
            <!-- telefono -->
            <div class="form-group h-14">
                <strong>Telefono:</strong>
                <input class="bg-white rounded-sm h-11 w-full border-gray-300" name="telefono" autofocus>
            </div>
            <!-- telefono 2 -->
            <div class="form-group h-14">
                <strong>Telefono altern:</strong>
                <input class="bg-white rounded-sm h-11 w-full border-gray-300" name="telefono_op" autofocus>
            </div>
            <!-- email -->
            <div class="form-group h-14">
                <strong>email:</strong>
                <input class="bg-white rounded-sm h-11 w-full border-gray-300" name="email" required autofocus>
            </div>
            <!-- email 2 -->
            <div class="form-group h-14">
                <strong>email altern:</strong>
                <input class="bg-white rounded-sm h-11 w-full border-gray-300" name="email_op" autofocus>
            </div>
    </div>
        <div class="pull-right py-2 px-2">
            <button type="submit" class="btn btn-success">Cargar</button>
        </div>
</div>
</form>
</body>


