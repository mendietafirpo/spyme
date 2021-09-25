<?php
use Carbon\Carbon;
?>
<head>
@include('layouts.head')
@include('flash-message')
</head>
<body>
@include('layouts.main')
    <div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2 my-2">
        <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
                Editar datos de persona
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
<form class="bg-green-100 w-3/4 mx-2" action="{{ route('personas.update',$persona->idPers) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>DNI:</strong>
                    <input type="text" name="documentoIdentidad" value="{{ $persona->documentoIdentidad }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Apellido y Nombres:</strong>
                    <input class="form-control" style="height:50px" name="nombresApellido" value="{{ $persona->nombresApellido }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de nacimiento:</strong>
                    @if($persona->fechaNacimiento)
                        <input class="form-control" name="fechaNacimiento" type="date" value="{{ Carbon::parse($persona->fechaNacimiento)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="fechaNacimiento" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Estado civil:</strong>
                <select name="esatadoCivil" id="esatadoCivil" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                @foreach($dfeciv as $id => $ec)
                <option value="{{ $id }}" {{ ( $id == $persona->esatadoCivil) ? 'selected' : '' }}>
                    {{ $ec }}
                </option>
                @endforeach
                </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Estudios cursados:</strong>
                <select name="estudiosCursados" id="estudiosCursados" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                @foreach($dfecurs as $id => $ecu)
                    <option value="{{ $id }}" {{ ( $id == $persona->estudiosCursados) ? 'selected' : '' }}>
                        {{ $ecu }}
                    </option>
                @endforeach
                </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Dirección Particular:</strong>
                    <input class="form-control" style="height:50px" name="direccionParticular"  value="{{ $persona->direccionParticular }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ciudad:</strong>
                    <select name="ciudad" id="ciudad" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($cities as $ciudad => $op)
                        <option value="{{ $op }}" {{ ( $op == $persona->ciudad) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Dedicación:</strong>
                    <input class="form-control" style="height:50px" name="dedicacion" value="{{ $persona->dedicacion }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nacionalidad:</strong>
                    <input class="form-control" style="height:50px" name="nacionalidad" value="{{ $persona->nacionalidad }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Departamento:</strong>
                    <select name="distrito" id="distrito" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($districts as $distrito => $op)
                        <option value="{{ $op }}" {{ ( $op == $persona->distrito) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Provincia:</strong>
                    <select name="estado" id="estado" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($states as $estado => $op)
                        <option value="{{ $op }}" {{ ( $op == $persona->estado) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>

                </div>
            </div>´
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pais:</strong>
                    <select name="pais" id="pais" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($countries as $pais => $op)
                        <option value="{{ $op }}" {{ ( $op == $persona->pais) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefono:</strong>
                    <input class="form-control" style="height:50px" name="telefono" placeholder="telefono1" value="{{ $persona->telefono }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefono altern:</strong>
                    <input class="form-control" style="height:50px" name="telefono_op" placeholder="telefono2" value="{{ $persona->telefono_op }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control" style="height:50px" name="email" placeholder="email" value="{{ $persona->email }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email altern:</strong>
                    <input class="form-control" style="height:50px" name="email_op" placeholder="email altern" value="{{ $persona->email_op }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Tipo relación empresarial:</strong>
                <select name="tipoRelacion" id="tipoRelacion" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                @foreach ($persona->firmas as $firma)
                @foreach($fprel as $id => $fp)
                <option value="{{ $id }}" {{ ($id == $firma->pivot->tipoRelacion) ? 'selected' : '' }}>
                    {{ $fp }} ({{ $id }})
                </option>
                @endforeach
                @endforeach
                </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" onclick="confirmar()" class="btn btn-primary">Realizar cabios</button>
            </div>
        </div>
    </form>
</body>
