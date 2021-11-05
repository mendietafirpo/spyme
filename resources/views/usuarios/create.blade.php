<head>
    @include('layouts.head')
    @include('flash-message')
</head>
<header>
    @include('layouts.header')
</header>
<body>
    @include('layouts.main')
    <div class="bg-red-100 font-semibold text-xl text-green-500 rounded-md px-2 py-2 mx-4 w-3/4">
            Ingresar nuevo usuario
    </div>
    <div class="bg-gray-200 ml-4 w-3/4 px-2 py-2">
        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" :value="__('Name')">Nombre</label>
                <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Username -->
            <div>
                <label for="username" :value="__('username')">Username</label>
                <input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" :value="__('Email')">Email</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" :value="__('Password')">Password</label>
                <input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password">
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" :value="__('Confirm Password')">Confirmar Password</label>
                <input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required>
            </div>
            <!-- roles -->
            <div class="mt-4">
            <label for="roles" class="block font-medium text-sm text-gray-700">Roles</label>
                <select name="roles[]" id="roles" class="form-multiselect rounded-md shadow-sm mt-1 w-full" multiple="multiple">
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @error('roles')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-end mt-4">
                <div class="pull-right">
                <button type="submit" class="btn btn-success">Cargar</button>
                </div>
            </div>
        </form>
    </div>
</body>
