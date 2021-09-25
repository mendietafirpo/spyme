<?php
use Carbon\Carbon;
?>

<head>
@include('layouts.head')
</head>
<body>
@include('layouts.main')
    <div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2">
        <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
            Información de trámite
        </div>
        <div class="flex justify-end py-2 px-2">
        <a class="btn btn-warning h-9" href="{{ route('tramites.edit',$tramite->idProy) }}"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
            &nbsp
            &nbsp
        <a href="javascript: history.go(-1)" class="btn btn-primary"> Volver</a>
        </div>
    </div>
    <table class="table table-bordered w-3/4">
        <tr>
			<td class="bg-gray-200 w-1/2"><strong>idProy:</td></strong>
            @if($tramite->idProy)
			<td class="bg-blue-100 w-1/2">{{ $tramite->idProy }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Presentacion Idea Proy:</td></strong>
            @if($tramite->presentacionIdeaProy)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->presentacionIdeaProy)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Consulta Agente Financiamiento:</td></strong>
            @if($tramite->consultaAgenteFinan)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->consultaAgenteFinan)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Informe Sujeto Credito:</td></strong>
            @if($tramite->informeSujetoCredito)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->informeSujetoCredito)->format('d/m/Y') }}</td>
            @endif
		</tr>
    	<tr>
			<td class="bg-gray-200 w-1/2"><strong>Sujeto Credito:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $tramite->sujetoCredito }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Remision Organismo:</td></strong>
            @if($tramite->remisionOrganismo)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->remisionOrganismo)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Aprobacion Tecnica:</td></strong>
            @if($tramite->aprobacionTecnica)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->aprobacionTecnica)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Resolucion Elegibilidad:</td></strong>
            @if($tramite->resolucionElegibilidad)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->resolucionElegibilidad)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Transferencia Fondos:</td></strong>
            @if($tramite->transferenciaFondos)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->transferenciaFondos)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Efectivizacion:</td></strong>
            @if($tramite->efectivizacion)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->efectivizacion)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Fecha Desistido:</td></strong>
            @if($tramite->fechaDesistido)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->fechaDesistido)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Fecha Dado DeBaja:</td></strong>
            @if($tramite->fechaDadoDeBaja)
			<td class="bg-blue-100 w-1/2">{{ Carbon::parse($tramite->fechaDadoDeBaja)->format('d/m/Y') }}</td>
            @endif
		</tr>
	</table>
</body>
