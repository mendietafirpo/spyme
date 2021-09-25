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
                Editar datos de trámite
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
<form class="bg-green-100 w-3/4 mx-2" action="{{ route('expedientes.update',$expediente->idProy) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-6 gap-x-3">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Id Proy:</strong>
                    <input type="text" name="idProy" value="{{ $expediente->idProy }}" readonly class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Entidad Fuente De Fondos:</strong>
                    <input class="form-control" name="entidadFuenteDeFondos" type="text" value="{{ $expediente->entidadFuenteDeFondos }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>'Operatoria Programa:</strong>
                    <select name="operatoriaPrograma" id="operatoriaPrograma" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($operatoria as $operatoriaPrograma => $op)
                        <option value="{{ $op }}" {{ ( $op == $expediente->operatoriaPrograma) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Id Expediente:</strong>
                    <input class="form-control" name="idExpediente" type="text" value="{{ $expediente->idExpediente }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Agente Financiero:</strong>
                    <select name="agenteFinanciero" id="agenteFinanciero" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($banco as $agenteFinanciero => $op)
                        <option value="{{ $op }}" {{ ( $op == $expediente->agenteFinanciero) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sucursal:</strong>
                    <select name="sucursalVentanilla" id="sucursalVentanilla" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($sucursal as $sucursalVentanilla => $op)
                        <option value="{{ $op }}" {{ ( $op == $expediente->sucursalVentanilla) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Evaluador Tecnico:</strong>
                    <select name="evaluadorTecnico" id="evaluadorTecnico" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($tecnico as $evaluadorTecnico => $op)
                        <option value="{{ $op }}" {{ ( $op == $expediente->evaluadorTecnico) ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
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
