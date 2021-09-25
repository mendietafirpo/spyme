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
            Editar item presupuesto
        </h2>
    </div>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('presupuestos.update', $presupuesto->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="item" class="block font-medium text-sm text-gray-700">item</label>
                            <input type="text" name="item" id="item" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('item', $presupuesto->item) }}" />
                            @error('item')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="rubroAplFon" class="block font-medium text-sm text-gray-700">Entidad rubro</label>
                            <select name="rubroAplFon" id="rubroAplFon" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                            @foreach($dfrubinv as $id => $ri)
                                <option value="{{ $id }}" {{ ( $id == $presupuesto->rubroAplFon) ? 'selected' : '' }}>
                                    {{ $ri }}
                                </option>
                            @endforeach
                            </select>
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <input type="text" name="descriction" id="descripcion" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('descripcion', $presupuesto->descripcion) }}" />
                            @error('descripcion')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="cantidad" class="block font-medium text-sm text-gray-700">cantidad</label>
                            <input type="text" name="cantidad" id="cantidad" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('cantidad', $presupuesto->cantidad) }}" />
                            @error('cantidad')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="precioSinIva" class="block font-medium text-sm text-gray-700">Precio sin IVA</label>
                            <input type="text" name="precioSinIva" id="precioSinIva"  type="number" step="0.01 class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('precioSinIva', $presupuesto->precioSinIva) }}" />
                            @error('precioSinIva')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="montoIva" class="block font-medium text-sm text-gray-700">Montto IVA</label>
                            <input type="text" name="montoIva" id="montoIva"  type="number" step="0.1 class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('montoIva', $presupuesto->montoIva) }}" />
                            @error('montoIva')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="montoTotal" class="block font-medium text-sm text-gray-700">Montto IVA</label>
                            <input type="text" name="montoTotal" id="montoTotal"  type="number" step="0.1 class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('montoTotal', $presupuesto->montoTotal) }}" />
                            @error('montoTotal')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="montoAportePropio" class="block font-medium text-sm text-gray-700">Montto IVA</label>
                            <input type="text" name="montoAportePropio" id="montoAportePropio"  type="number" step="0.1 class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('montoAportePropio', $presupuesto->montoAportePropio) }}" />
                            @error('montoAportePropio')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="observaciones" class="block font-medium text-sm text-gray-700">observaciones</label>
                            <input type="text" name="observaciones" id="observaciones" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('observaciones', $presupuesto->observaciones) }}" />
                            @error('observaciones')
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
                                Modificar
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
