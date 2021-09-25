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
            Visualizar firmas
        </div>
        <div class="flex justify-end py-2 px-2">
            <a class="btn btn-warning h-9" href="{{ route('firmas.edit',$firma->idFirma) }}"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
            &nbsp
            &nbsp
            <a href="javascript: history.go(-1)" class="btn btn-primary"> Volver</a>
        </div>
    </div>
    <table class="table table-bordered w-1/2">
		<tr>
			<td class="bg-gray-200 w-32"><strong> Cuit:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->cuit }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Razón Scocial:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->razonSocial }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Tipo Jurídico:</td></strong>
                @foreach($dffjur as $id => $fj)
                @if ($id==$firma->formaJuridica)
                <td class="bg-blue-100 w-62"> {{ $fj }}</td>
                @endif
                @endforeach
    	</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Situación Afip:</td></strong>
                @foreach($dfafip as $id => $afip)
                @if ($id==$firma->situacionAfip)
                <td class="bg-blue-100 w-62"> {{ $afip }} </td>
                @endif
                @endforeach
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Fecha fundación:</td></strong>
			@if ($firma->fechaFundacion)
            <td class="bg-blue-100 w-62">{{ Carbon::parse($firma->fechaFundacion)->format('d/m/Y') }}</td>
            @endif
		</tr>
        <tr>
			<td class="bg-gray-200 w-32"><strong> Dirección Legal:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->direccionLegal }}</td>
		</tr>
        <tr>
			<td class="bg-gray-200 w-32"><strong> Localidad:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->ciudad }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Departamento/Distrito:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->departamento }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Provincia/Estado:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->provincia }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> País:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->pais }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Teléfono:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->telefono }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Teléfono altern:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->telefono_op }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Email:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->email }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Email altern:</td></strong>
			<td class="bg-blue-100 w-62">{{ $firma->email_op }}</td>
		</tr>
		</table>
</body>
