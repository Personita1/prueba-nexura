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
        <div class="container pr-5 pl-5 mt-4">
            <h4>Crear empleado</h4>
            <div class="alert alert-info" role="alert">
                Los campos con asteriscos (*) son obligatorios
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="formCrearEmpleado" action="/guardar" method="post">
                @csrf
                <div class="mb-3 row">
                    <label for="inputNombre" class="col-sm-3 col-form-label fw-bold text-end" required>Nombre completo * </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="Nombre completo del empleado">
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputEmail" class="col-sm-3 col-form-label fw-bold text-end"  >Correo electrónico * </label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Correo electrónico">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="checkSexo" class="col-sm-3 col-form-label fw-bold text-end"> Sexo * </label>
                    <div id="checkSexo" class="col-sm-9" >
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexo" id="inputMasc" value="M">
                            <label class="form-check-label" for="inputMasc">
                                Masculino
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexo" id="inputFem" value="F">
                            <label class="form-check-label" for="inputFem">
                                Femenino
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="selectArea" class="col-sm-3 col-form-label fw-bold text-end"> Área * </label>
                    <div id="selectArea" class="col-sm-9" >
                        <select class="form-select" name="area_id" aria-label="Default select example">
                            @forelse( $areas as $area )
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                            @empty
                            <option> No hay áreas </option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDescripcion" class="col-sm-3 col-form-label fw-bold text-end">Descripción * </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="inputDescripcion" 
                            placeholder="Descripcion de  la experiencia del empleado" name="descripcion"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputBoletin" class="col-sm-3 col-form-label fw-bold text-end"></label>
                    <div class="form-check col-sm-9" id="inputBoletin">
                        <input class="form-check-input" type="checkbox" value="1" id="inputBoletin" name=boletin>
                        <label class="form-check-label" for="inputBoletin">
                            Deseo recibir boletín informativo
                        </label>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputRol" class="col-sm-3 col-form-label fw-bold text-end">Roles * </label>
                    <div id="inputRol" class="col-sm-9">
                    @forelse($roles as $rol)
                    <div class="row">
                        <label class="col-sm-3"></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$rol->id}}" id="checkRol" name="roles[{{$rol->id}}]">
                            <label class="form-check-label" for="checkRol">
                                {{ $rol->nombre }}
                            </label>
                        </div>
                    </div>
                    @empty
                    <label class="form-check-label"> No hay roles </label>
                    @endforelse
                    </div>
                </div>
            </form>
            <div class="mb-3 row">
                <label class="col-sm-3"></label>
                <div class="col-sm-9">
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </body>

    <script>
        $('#btnGuardar').on('click', function(){
            let guardar = true
            $('input').each(function(i){
                if(!$(this).val()){
                    $(this).addClass('is-invalid')
                    guardar = false;
                } else {
                    $(this).removeClass('is-invalid')
                    $(this).addClass('is-valid')
                }
            })
            $('input#inputBoletin').removeClass('is-invalid')
            $('input#checkRol').each(function(i){
                if($(this).is(':checked')){
                    $('input#checkRol').removeClass('is-invalid')
                    $(this).addClass('is-valid')
                    guardar = true
                }
            })
            if(!$('textarea#inputDescripcion').val()){
                $('textarea#inputDescripcion').addClass('is-invalid')
                guardar = false
            }else{
                $('textarea#inputDescripcion').removeClass('is-invalid')
                $('textarea#inputDescripcion').addClass('is-valid')
            }
            if(!$('input#inputFem').is(':checked') && !$('input#inputMasc').is(':checked') ){
                $('input#inputFem').addClass('is-invalid')
                $('input#inputMasc').addClass('is-invalid')
                guardar = false
            } else if ($('input#inputFem').is(':checked')){
                $('input#inputFem').removeClass('is-invalid')
                $('input#inputFem').addClass('is-valid')
                $('input#inputMasc').removeClass('is-valid')
            } else if ($('input#inputMasc').is(':checked')){
                $('input#inputMasc').addClass('is-valid')
                $('input#inputFem').removeClass('is-valid')
            }
            console.log(guardar)
            if(guardar){
                console.log('vamos a guardar')
                $('#formCrearEmpleado').submit();
            }
        })
    </script>
</html>
