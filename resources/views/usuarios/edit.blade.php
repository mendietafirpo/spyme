<head>
    @include('layouts.head')
</head>
<header>
    @include('layouts.header')
</header>
<body>
    @include('layouts.main')
    <div class="bg-red-100 font-semibold text-xl text-green-500 rounded-md px-2 py-2 mx-4 w-3/4">
            Modificar usuario: {{ $user->name}}
    </div>

    <div>
        <div class="max-w-4xl mx-auto py-1 sm:px-1 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-1">
                <form method="post" action="{{ route('usuarios.update', $user->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="username" class="block font-medium text-sm text-gray-700">Username</label>
                            <input type="text" name="username" id="username" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('username', $user->username) }}" />
                            @error('username')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('name', $user->name) }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', $user->email) }}" disabled/>
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="direccion" class="block font-medium text-sm text-gray-700">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    value="{{ old('direccion', $user->direccion) }}" />
                            @error('telefono')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="telefono" class="block font-medium text-sm text-gray-700">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('telefono', $user->telefono) }}" />
                            @error('telefono')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="ciudad" class="block font-medium text-sm text-gray-700">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('ciudad', $user->ciudad) }}" />
                            @error('ciudad')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="pais" class="block font-medium text-sm text-gray-700">Pais</label>
                            <input type="text" name="pais" id="pais" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('pais', $user->pais) }}" />
                            @error('pais')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!--<div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                        @foreach($roles as $id => $role)
                                    <p class="text-sm text-red-600"> Id: {{ $id }} </p>
                                    <p class="text-sm text-red-600"> Role: {{ $role }} </p>
                                    <p class="text-sm text-red-600"> Pluck: {{ $user->roles->pluck('id') }} </p>

                        @endforeach
                        </div>-->
                        <div class="my-1 px-1 py-1 bg-gray-200 sm:p-1 w-3/4">
                            <label for="roles" class="block font-medium text-sm text-gray-700">Roles</label>
                            <select name="roles[]" id="roles" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}"{{ in_array($id, old('roles', $user->roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-1 bg-gray-50 text-right sm:px-1">
                            <button class="inline-flex items-center px-4 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Realizar cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
