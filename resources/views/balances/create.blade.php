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
            Agregar nuevo item de inversión
        </h2>
    </div>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('balances.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <input name="id" hidden id="id" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ $idLast }}" />
                            <input name="idFirma" hidden id="idProy" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ $idFirma }}" />

                            <label for="entidadRubro" class="block font-medium text-sm text-gray-700">Entidad Rubro</label>
                            <select name="entidadRubro" id="entidadRubro" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                            <option value=""></option>
                            @foreach($dfentrubro as $id => $er)
                                <option value="{{ $id }}" {{ (old("entidadRubro") == $er ? "selected":"") }}>{{ $er }}</option>
                            @endforeach
                            </select>
                            @error('entidadRubro')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="rubro" class="block font-medium text-sm text-gray-700">Rubro inversión</label>
                            <select name="rubro" id="rubro" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                            <option value=""></option>
                            @foreach($dfrubinv as $id => $rub)
                                <option value="{{ $id }}" {{ (old("rubro") == $er ? "selected":"") }}>{{ $rub }}</option>
                            @endforeach
                            </select>
                            @error('rubro')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripcion</label>
                            <input name="descripcion" id="descriccion" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('descripcion', '') }}" />
                            @error('descripcion')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="cantidad" class="block font-medium text-sm text-gray-700">Cantidad</label>
                            <input name="cantidad" type="number" step="0.01" id="cantidad" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('cantidad', '') }}" />
                            @error('cantiad')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="monto" class="block font-medium text-sm text-gray-700">Monto</label>
                            <input name="monto" type="number" step="0.1" id="monto" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('monto', '') }}" />
                            @error('cantiad')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="observaciones" class="block font-medium text-sm text-gray-700">observaciones</label>
                            <input name="observaciones" id="observacion" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('observacionn', '') }}" />
                            @error('observaciones')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                        <a class="btn btn-primary pull-left" href="{{ url('/pymes/mysmes') }}">Volver</a>

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
