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
<form class="bg-green-100 w-3/4 mx-2" action="{{ route('tramites.update',$tramite->idProy) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="grid lg:grid-flow-row lg:grid-cols-2 sm:grid-cols-1 lg:grid-rows-6 gap-x-3">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Id Proy:</strong>
                    <input type="text" name="idProy" value="{{ $tramite->idProy }}" readonly class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>presentacionIdeaProy:</strong>
                    @if($tramite->presentacionIdeaProy)
                        <input class="form-control" name="presentacionIdeaProy" type="date" value="{{ Carbon::parse($tramite->presentacionIdeaProy)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="presentacionIdeaProy" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Consulta Agente Finan:</strong>
                    @if($tramite->consultaAgenteFinan)
                        <input class="form-control" name="consultaAgenteFinan" type="date" value="{{ Carbon::parse($tramite->consultaAgenteFinan)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="consultaAgenteFinan" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Informe Sujeto Credito:</strong>
                    @if($tramite->informeSujetoCredito)
                        <input class="form-control" name="informeSujetoCredito" type="date" value="{{ Carbon::parse($tramite->informeSujetoCredito)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="informeSujetoCredito" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sujeto de Credito:</strong>
                        <input class="form-control" name="sujetoCredito" value="{{ $tramite->sujetoCredito }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Remision Organismo:</strong>
                    @if($tramite->remisionOrganismo)
                        <input class="form-control" name="remisionOrganismo" type="date" value="{{ Carbon::parse($tramite->remisionOrganismo)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="remisionOrganismo" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>aprobacionTecnica:</strong>
                    @if($tramite->aprobacionTecnica)
                        <input class="form-control" name="aprobacionTecnica" type="date" value="{{ Carbon::parse($tramite->aprobacionTecnica)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="aprobacionTecnica" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Resolucion Elegibilidad:</strong>
                    @if($tramite->resolucionElegibilidad)
                        <input class="form-control" name="resolucionElegibilidad" type="date" value="{{ Carbon::parse($tramite->resolucionElegibilidad)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="resolucionElegibilidad"type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Transferencia de Fondos:</strong>
                    @if($tramite->transferenciaFondos)
                        <input class="form-control" name="transferenciaFondos" type="date" value="{{ Carbon::parse($tramite->transferenciaFondos)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="transferenciaFondos" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Efectivizacion:</strong>
                    @if($tramite->efectivizacion)
                        <input class="form-control" name="efectivizacion" type="date" value="{{ Carbon::parse($tramite->efectivizacion)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="efectivizacion" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha Desistido:</strong>
                    @if($tramite->fechaDesistido)
                        <input class="form-control" name="fechaDesistido" type="date" value="{{ Carbon::parse($tramite->fechaDesistido)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="fechaDesistido" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Dado de baja:</strong>
                    @if($tramite->fechaDadoDeBaja)
                        <input class="form-control" name="fechaDadoDeBaja" type="date" value="{{ Carbon::parse($tramite->fechaDadoDeBaja)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="fechaDadoDeBaja" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" onclick="confirmar()" class="btn btn-primary">Realizar cabios</button>
            </div>
        </div>
    </form>
</body>
