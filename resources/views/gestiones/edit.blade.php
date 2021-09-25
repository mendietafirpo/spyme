<?php
use Carbon\Carbon;
?>

<head>
@include('layouts.head')
</head>
<body>
@include('layouts.main')
    <div class="bg-green-200">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar gestión trámite
        </h2>
    </div>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('gestiones.update', $gestion->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="fechatramite" class="block font-medium text-sm text-gray-700">Fecha tramite</label>
                            @if($gestion->fechatramite)
                                <input class="form-control" name="fechatramite" type="date" value="{{ Carbon::parse($gestion->fechatramite)->format('Y-m-d') }}">
                            @else
                                <input class="form-control" name="fechatramite" type="date">
                            @endif
                            <label for="proceso" class="block font-medium text-sm text-gray-700">Proceso / evento</label>
                            <select name="proceso" id="proceso" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                            @foreach($procesos as $proceso => $pcs)
                                <option value="{{ $pcs }}" {{ ( $proceso == $gestion->proceso) ? 'selected' : '' }}>
                                    {{ $pcs }}
                                </option>
                            @endforeach
                            </select>
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('descripcion', $gestion->descripcion) }}" />
                            @error('descripcion')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="entidad_emisora" class="block font-medium text-sm text-gray-700">entidad_emisora</label>
                            <input type="text" name="entidad_emisora" id="entidad_emisora" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('entidad_emisora', $gestion->entidad_emisora) }}" />
                            @error('entidad_emisora')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="operador_emisor" class="block font-medium text-sm text-gray-700">operador emisor</label>
                            <input type="text" name="operador_emisor" id="operador_emisor" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('operador_emisor', $gestion->operador_emisor) }}" />
                            @error('operador_emisor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="entidad_receptora" class="block font-medium text-sm text-gray-700">entidad receptora</label>
                            <input type="text" name="entidad_receptora" id="entidad_receptora" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('entidad_receptora', $gestion->entidad_receptora) }}" />
                            @error('entidad_receptora')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="operador_receptor" class="block font-medium text-sm text-gray-700">operador_receptor</label>
                            <input type="text" name="operador_receptor" id="operador_receptor" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('operador_receptor', $gestion->operador_receptor) }}" />
                            @error('operador_receptor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>
                        @if (session('idFirma'))
                            <a class="btn btn-primary pull-left mx-2" href="{{ url('/proyectos/proyecto/'.session('idFirma')) }}">Volver</a>
                        @else
                            <a href="javascript: history.go(-1)" class="btn btn-primary pull-left mx-2"> Volver</a>
                        @endif

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Modificar
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
