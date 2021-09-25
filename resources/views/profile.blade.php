<head>
    @include('layouts.head')
</head>
<header>
    @include('layouts.header')
</header>
<body>
@include('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                            <div class="col-md-6">
                                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono</label>
                                            <div class="col-md-6">
                                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono', auth()->user()->telefono) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="direccion" class="col-md-4 col-form-label text-md-right">Direccion</label>
                                            <div class="col-md-6">
                                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion', auth()->user()->direccion) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ciudad" class="col-md-4 col-form-label text-md-right">Ciudad</label>
                                            <div class="col-md-6">
                                                <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciudad', auth()->user()->ciudad) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pais" class="col-md-4 col-form-label text-md-right">Pais</label>
                                            <div class="col-md-6">
                                                <input id="paiso" type="text" class="form-control" name="pais" value="{{ old('pais', auth()->user()->pais) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
                                            <div class="col-md-6">
                                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                                                @if (auth()->user()->image)
                                                    <code>{{ auth()->user()->image }}</code>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
