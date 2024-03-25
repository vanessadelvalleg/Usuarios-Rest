<!DOCTYPE html>
<html>
<head>
    <title>Test Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
    <body>
<div class="container">
  <br>
    <div class="row ">
        <div class="col-md-4 offset-md-4">
        <h2>Editar Usuario</h2>
    <form id="update-users" class="card p-3 bg-light" action="{{ route('users.update' , $user->id) }}"  enctype="multipart/form-data" >
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div id="validation-errors" role="alert">
    </div>
    <div class="mb-3">

    <input type="hidden" class="form-control d-none" id="id" name="id" value="{{$user->id}}">
  </div>
        <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$user->nombre}}">
  </div>
  <div class="mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido" value="{{$user->apellido}}">
  </div>
        <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
  </div>


  <div class="mb-3">
                @if ($user->imgperfil)
               
                <label for="ruta" class="form-label">Ruta / Nombre de la imagen de perfil</label>
                <input type="text" class="form-control" id="ruta"  value="{{$user->imgperfil}}">
                @endif
                <br>
                <label class="form-label" for="imgperfil">Imagen de perfil nueva</label>
                <input 
                    type="file" 
                    name="imgperfil" 
                    id="imgperfil"
                    class="form-control @error('image') is-invalid @enderror">
  
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                
            </div>

  <button type="submit" class="btn btn-primary submit-button">Actualizar</button>
    </form>
</div>
<script>

        $('#update-users').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr("action");
        let formData = new FormData(this);
  
        $.ajax({
                type:'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                $('#validation-errors').html('');
                $('#validation-errors').append('<div class="alert alert-success">'+data+'</div');
                window.location.href = "{{route('user-show')}}";
                },
                error: function (xhr) {
                 
                 $('#validation-errors').html('');
                 $.each(xhr.responseJSON, function(key,value) {
                     $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                 }); 
                 },
           });
        
    });

</script>