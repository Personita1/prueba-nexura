<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Listado Empleados</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a6e2c5bd4f.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

       
    </head>
    <body>
        <div class="container mt-4">
            <h4>Listado de empleados</h4>
            <a type="button" class="btn btn-primary float-end" id="btnCrear" href="/crear"><i class="fa-solid fa-user-plus"></i> Crear</a>
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th><i class="fa-solid fa-user"></i> Nombre</th>
                        <th><i class="fa-solid fa-at"></i> Email</th>
                        <th><i class="fa-solid fa-venus-mars"></i> Sexo</th>
                        <th><i class="fa-solid fa-briefcase"></i> Área</th>
                        <th><i class="fa-solid fa-envelope"></i> Boletín</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody >
                    @forelse($empleados as $empleado)
                    <tr class="text-center align-middle">
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>{{ $empleado->sexo  }}</td>
                        <td>{{ $empleado->area->nombre }}</td>
                        <td>{{ $empleado->boletin }}</td>
                        <td><button class="btn"> <i class="fa-solid fa-pen-to-square"></i> </button> </td>
                        <td><button class="btn" onclick="eliminar({{$empleado->id}})"> <i class="fa-solid fa-trash-can"></i> </button></td>
                    </tr>
                    @empty
                    <tr>
                        "La lista está vacía"
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </body>

    <script>
        function eliminar(id) {
            console.log(id)
             $.ajax({
                method:'POST',
                url:'/eliminar/{id}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id}
                })
            .done(function() {
                alert( "Listo, empleado eliminado" )
                location.reload()
            })
            .fail(function() {
                alert( "No se pudo eliminar" );
            })
            .always(function() {
                alert( "Terminado" );
            });
        }
    </script>
</html>
