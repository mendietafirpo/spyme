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
                Editar firma
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
<form class="bg-green-100 w-3/4 mx-2" action="{{ route('firmas.update',$firma->idFirma) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cuit:</strong>
                    <input type="text" name="cuit" value="{{ $firma->cuit }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Forma Juridica:</strong>
                <select name="formaJuridica" id="formaJuridica" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                @foreach($dffjur as $id => $fj)
                    <option value="{{ $id }}" {{ ( $id == $firma->formaJuridica) ? 'selected' : '' }}>
                        {{ $fj }}
                    </option>
                @endforeach
                </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Situacion Afip:</strong>
                <select name="situacionAfip" id="situacionAfip" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                @foreach($dfafip as $id => $afip)
                <option value="{{ $id }}" {{ ( $id == $firma->situacionAfip) ? 'selected' : '' }}>
                    {{ $afip }}
                </option>
                @endforeach
                </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Razón Social:</strong>
                    <input class="form-control" style="height:50px" name="razonSocial" value="{{ $firma->razonSocial }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha fundación:</strong>
                    @if($firma->fechaFundacion)
                        <input class="form-control" name="fechaFundacion" type="date" value="{{ Carbon::parse($firma->fechaFundacion)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="fechaFundacion" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Dirección legal:</strong>
                    <input class="form-control" style="height:50px" name="direccionLegal" value="{{ $firma->direccionLegal }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Localidad:</strong>
                    <select name="ciudad" id="ciudad" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($cities as $ciudad => $op)
                        <option value="{{ $op }}" {{ ( $op == $firma->ciudad) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Provincia:</strong>
                    <select name="provincia" id="provincia" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($states as $provincia => $op)
                        <option value="{{ $op }}" {{ ( $op == $firma->provincia) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Departamento:</strong>
                    <select name="departamento" id="departamento" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($districts as $departamento => $op)
                        <option value="{{ $op }}" {{ ( $op == $firma->departamento) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pais:</strong>
                    <select name="pais" id="pais" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($countries as $pais => $op)
                        <option value="{{ $op }}" {{ ( $op == $firma->pais) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefono 1:</strong>
                    <input class="form-control" style="height:50px" name="telefono" value="{{ $firma->telefono }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefono 2:</strong>
                    <input class="form-control" style="height:50px" name="telefono_op" value="{{ $firma->telefono_op }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control" style="height:50px" name="email" value="{{ $firma->email }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email 2:</strong>
                    <input class="form-control" style="height:50px" name="email_op" value="{{ $firma->email_op }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" onclick="confirmar()" class="btn btn-primary">Realizar cambios</button>
            </div>
        </div>
    </form>
</body>
