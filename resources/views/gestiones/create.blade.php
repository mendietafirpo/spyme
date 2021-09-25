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
            Agregar nuevo item de trámite
        </h2>
    </div>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('gestiones.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <input name="id" hidden id="id" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ $idLast }}" />
                            <input name="idProy" id="idProy" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ $idProy }}" />
                            <label for="fechatramite" class="block font-medium text-sm text-gray-700">Fecha del tramite</label>
                            <input name="fechatramite" id="fechatramite" type="date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('fechatramite', '') }}" autofocus />
                            @error('fechatramite')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <label for="proceso" class="block font-medium text-sm text-gray-700">Proceso / evento</label>
                            <select name="proceso" id="proceso" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                            <option value=""></option>
                            @foreach($procesos as $proceso => $pcs)
                                <option value="{{ $pcs }}" {{ (old("proceso") == $pcs ? "selected":"") }}>{{ $pcs }}</option>
                            @endforeach
                            </select>
                            @error('proceso')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripcion</label>
                            <input name="descripcion" id="descriction" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('description', '') }}" />
                            @error('descripcion')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="entidad_emisora" class="block font-medium text-sm text-gray-700">Entidad emisora</label>
                            <input name="entidad_emisora" type="number" id="entidad_emisora" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('entidad_emisora', '') }}" />
                            @error('entidad_emisora')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="operador_emisor" class="block font-medium text-sm text-gray-700">Quien emite</label>
                            <input name="operador_emisor" type="text" id="operador_emisor" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('operador_emisor', '') }}" />
                            @error('operador_emisor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="entidad_receptora" class="block font-medium text-sm text-gray-700">Entidad receptora</label>
                            <input name="entidad_receptora" type="text" id="entidad_receptora" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('entidad_receptora', '') }}" />
                            @error('entidad_receptora')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="operador_receptor" class="block font-medium text-sm text-gray-700">Quien recepciona</label>
                            <input name="operador_receptor" type="text" id="operador_receptor" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('operador_receptor', '') }}" />
                            @error('operador_receptor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                            @if (session('idFirma'))
                                <a class="btn btn-primary pull-left" href="{{ url('/proyectos/proyecto/'.session('idFirma')) }}">Volver</a>
                            @else
                                <a href="javascript: history.go(-1)" class="btn btn-primary pull-left"> Volver</a>
                            @endif

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Agregar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
