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
            Editar item manifestación de bienes
        </h2>
    </div>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('balances.update', $balance->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="item" class="block font-medium text-sm text-gray-700">item</label>
                            <input type="text" name="item" id="item" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('item', $balance->item) }}" />
                            @error('item')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="entidadRubro" class="block font-medium text-sm text-gray-700">Entidad rubro</label>
                            <select name="entidadRubro" id="entidadRubro" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                            @foreach($dfentrubro as $id => $er)
                                <option value="{{ $id }}" {{ ( $id == $balance->entidadRubro) ? 'selected' : '' }}>
                                    {{ $er }}
                                </option>
                            @endforeach
                            </select>
                            <label for="rubro" class="block font-medium text-sm text-gray-700">Entidad rubro</label>
                            <select name="rubro" id="rubro" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                            @foreach($dfrubinv as $id => $ri)
                                <option value="{{ $id }}" {{ ( $id == $balance->rubro) ? 'selected' : '' }}>
                                    {{ $ri }}
                                </option>
                            @endforeach
                            </select>
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <input type="text" name="descriction" id="descripcion" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('descripcion', $balance->descripcion) }}" />
                            @error('descripcion')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="cantidad" class="block font-medium text-sm text-gray-700">cantidad</label>
                            <input type="text" name="cantidad" id="cantidad"  type="number" step="0.01 class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('cantidad', $balance->cantidad) }}" />
                            @error('cantidad')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="monto" class="block font-medium text-sm text-gray-700">monto</label>
                            <input type="text" name="monto" id="monto"  type="number" step="0.1 class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('monto', $balance->monto) }}" />
                            @error('monto')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="observaciones" class="block font-medium text-sm text-gray-700">observaciones</label>
                            <input type="text" name="observaciones" id="observaciones" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('observaciones', $balance->observaciones) }}" />
                            @error('observaciones')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <a class="btn btn-primary pull-left" href="{{ url('/pymes/mysmes') }}">Volver</a>
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Modificar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
