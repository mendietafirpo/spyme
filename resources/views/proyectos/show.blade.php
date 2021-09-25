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
            Información del proyecto
        </div>
        <div class="flex justify-end py-2 px-2">
        <a class="btn btn-warning h-9" href="{{ route('proyectos.edit',$proyecto->idProy) }}"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
            &nbsp
            &nbsp
        <a href="javascript: history.go(-1)" class="btn btn-primary"> Volver</a>
        </div>
    </div>
    <table class="table table-bordered w-3/4">
		<tr>
			<td class="bg-gray-200 w-32"><strong>Fecha Referencia:</td></strong>
            @if($proyecto->fechaReferencia)
			<td class="bg-blue-100 w-62">{{ Carbon::parse($proyecto->fechaReferencia)->format('d/m/Y') }}</td>
            @endif
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Nombre Proyecto:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->nombreProyecto }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Bienes Que Produce:</td></strong>
			<td class="bg-blue-100 w-62 h-18">{{ $proyecto->bienesQueProduce }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Garantias Ofrecidas:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->garantiasOfrecidas }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Destino Fondos:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->destinoFondos }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Descripcion Proyecto:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->descripcionProyecto }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Antecentes:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->antecentes }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Justificacion:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->justificacion }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Moneda:</td></strong>
                @foreach($dfmoney as $id => $mon)
                @if ($id==$proyecto->moneda)
                <td class="bg-blue-100 w-62"> {{ $mon }}</td>
                @endif
                @endforeach
    	</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Tipo de Cambio:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->tipodeCambio }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Monto Act Fijo:</td></strong>
			<td class="bg-blue-100 w-62">{{ number_format($proyecto->montoActFijo, 0, ',', '.') }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Monto Cap trab:</td></strong>
			<td class="bg-blue-100 w-62">{{ number_format($proyecto->montoCapTrab, 0, ',', '.') }}</td>
		</tr>
        <tr>
			<td class="bg-gray-200 w-32"><strong> Inversion Total:</td></strong>
			<td class="bg-blue-100 w-62">{{ number_format($proyecto->inversionTotal, 0, ',', '.') }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Monto Total:</td></strong>
			<td class="bg-blue-100 w-62">{{ number_format($proyecto->montoTotal, 0, ',', '.') }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Personal Ocupado:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->personalOcupado }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> ciiuCs:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->ciiuCs }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Tasacion:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->Tasacion }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> nroPartida:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->nroPartida }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> nroMatricula:</td></strong>
			<td class="bg-blue-100 w-62">{{ $proyecto->nroMatricula }}</td>
		</tr>
	</table>
</body>
