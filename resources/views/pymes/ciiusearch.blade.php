<head>
@include('layouts.head')
@include('flash-message')
</head>
<header>
@include('layouts.header')
</header>

<body>
@include('layouts.main')

<!-- formularios de busqueda-->
<div class="grid grid-cols-1 bg-purple-200 px-2 w-3/4">
        <form role="Search" name="searchciiu">
            <div class="form-group mt-2 inline-block">
                <label class="inline-block mx-2 h-10" for="ciiuCt">Palabra clave:</label>
                <input class="inline-block mx-2 w-44 h-10 rounded-md" name="ciiu" class="form-control">
                <button type="submit" class="inline-block bg-green-700 hover:bg-yellow-600 text-white font-bold py-1 px-2 pull-right rounded-md">Filtrar/buscar actividad</button>
            </div>
            <div class="form-group flex">
                <label>Lista de actividades</label>
                <select name="idciiu" id="idciiu" class="form-multiselect block h-10 rounded-md mx-2 mt-1 w-full">
                        <option value=""></option>
                        @foreach($dfciiu as $ciiuCs => $op)
                            <option value="{{ $ciiuCs }}" {{ (old("ciiuCs") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                </select>
            </div>
            <div>
            <button type="button" class="bg-black hover:bg-gray-500 text-white font-bold mt-2 py-1 px-2 pull-right rounded-md" onclick="closeWin()">Copiar código</button>
            </div>
        </form>
</div>

</body>
<script>
    function closeWin() {
        localStorage.setItem("miciiu", searchciiu['idciiu'].options[searchciiu['idciiu'].selectedIndex].value);
        window.close();
    }
</script>
<script src="{{ asset('/js/proyectos.js') }}"> </script>
