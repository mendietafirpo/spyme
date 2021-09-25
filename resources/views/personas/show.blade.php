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
            Información de personas
        </div>
        <div class="flex justify-end py-2 px-2">
        <a class="btn btn-warning h-9" href="{{ route('personas.edit',$persona->idPers) }}"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
            &nbsp
            &nbsp
        <a href="javascript: history.go(-1)" class="btn btn-primary"> Volver</a>
        </div>
    </div>
    <table class="table table-bordered w-1/2">
		<tr>
			<td class="bg-gray-200 w-32"><strong> DNI:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->documentoIdentidad }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Apellido y Nombres:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->nombresApellido }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Estado civil:</td></strong>
                @foreach($dfeciv as $id => $ec)
                @if ($id==$persona->estadoCivil)
                <td class="bg-blue-100 w-62"> {{ $ec }}</td>
                @endif
                @endforeach
    	</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Estudios cursados:</td></strong>
                @foreach($dfecurs as $id => $ecu)
                @if ($id==$persona->estudiosCursados)
                <td class="bg-blue-100 w-62"> {{ $ecu }} </td>
                @endif
                @endforeach
		</tr>
        <tr>
			<td class="bg-gray-200 w-32"><strong> Fecha de naciomiento:</td></strong>
            @if($persona->fechaNacimiento)
			<td class="bg-blue-100 w-62">{{ Carbon::parse($persona->fechaNacimiento)->format('d/m/Y') }}</td>
            @endif
		</tr>
        <tr>
			<td class="bg-gray-200 w-32"><strong> Dedicacion:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->dedicacion }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Direccion:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->direccionParticular }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Ciudad:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->ciudad }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Departamento:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->distrito }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Provincia:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->estado }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> País:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->pais }}</td>
		</tr>

		<tr>
			<td class="bg-gray-200 w-32"><strong> Nacionalidad:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->nacionalidad }}</td>
		</tr>		<tr>
			<td class="bg-gray-200 w-32"><strong> Teléfono:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->telefono }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Teléfono altern:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->telefono_op }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Email:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->email }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Email altern:</td></strong>
			<td class="bg-blue-100 w-62">{{ $persona->email_op }}</td>
		</tr>
		<tr>
			<td class="bg-gray-200 w-32"><strong> Tipo relacion empresarial:</td></strong>
                @foreach ($persona->firmas as $firma)
                    @foreach($fprel as $id => $fp)
                        @if ($id==$firma->pivot->tipoRelacion)
                        <td class="bg-blue-100 w-62"> {{ $fp }}</td>
                        @endif
                    @endforeach
                @endforeach
        </tr>

	</table>
</body>
