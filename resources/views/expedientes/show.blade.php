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
            Información del expediente
        </div>
        <div class="flex justify-end py-2 px-2">
        <a class="btn btn-warning h-9" href="{{ route('expedientes.edit',$expediente->idProy) }}"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
            &nbsp
            &nbsp
        <a href="javascript: history.go(-1)" class="btn btn-primary"> Volver</a>
        </div>
    </div>
    <table class="table table-bordered w-3/4">
        <tr>
			<td class="bg-gray-200 w-1/2"><strong>idProy:</td></strong>
            @if($expediente->idProy)
			<td class="bg-blue-100 w-1/2">{{ $expediente->idProy }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Entidad Fuente De Fondos:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $expediente->entidadFuenteDeFondos }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Operatoria Programa:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $expediente->operatoriaPrograma }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Id Expediente:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $expediente->idExpediente }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Agente Financiero:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $expediente->agenteFinanciero }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Sucursal:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $expediente->sucursalVentanilla }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Promotor Del Proyecto:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $expediente->promotorDelProyecto }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-1/2"><strong>Evaluador Tecnico:</td></strong>
			<td class="bg-blue-100 w-1/2">{{ $expediente->evaluadorTecnico }}</td>
		</tr>
	</table>
</body>
