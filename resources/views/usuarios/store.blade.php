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
        <h2>Nuevo Usuario</h2>
    <form id="new-users" class="card p-3 bg-light" action="{{ route('user-submit.form') }}" enctype="multipart/form-data" >
    @csrf
    <div id="validation-errors" role="alert">
    </div>
        <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre">
  </div>
  <div class="mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido">
  </div>
        <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" autocomplete="new-password"  id="password" name="password">
  </div>
  <div class="mb-3">
                <label class="form-label" for="imgperfil">Imagen de perfil</label>
                <input 
                    type="file" 
                    name="imgperfil" 
                    id="imgperfil"
                    class="form-control @error('image') is-invalid @enderror">
  
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

  <button type="submit" class="btn btn-primary submit-button">Guardar</button>
    </form>
</div>
<script>

        $('#new-users').submit(function(e) {
        e.preventDefault();
         
        var url = $(this).attr("action");
        let formData = new FormData(this);
        $.ajax({
                type:'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
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
