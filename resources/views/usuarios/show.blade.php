<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Usuarios CRUD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    </head>
    <body>
<div class="container">
  <br>
    <div class="row ">
        <div class="col-md-6">
            <h2>Usuarios</h2>
        </div>
        <div class="col-md-6">
            <div class="d-md-flex justify-content-md-end">
            <a href="{{ route('new-user') }}" class="btn btn-success"> Crear usuario</a>
            </div>
        </div>
        <br>

        <div class="col-md-12">
            <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th width="5%">#</th>
            <th>Nombre</th>
            <th >Apellido</th>
            <th>Email</th>
            <th>Imagen de Perfil</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody id='userlist'>

        </tbody>

      </table>
        </div>
    </div>
</div>

    </body>
    <script type="text/javascript">


$.ajax({
    url: '/api/users', 
    type: 'GET',
    dataType: 'json',
    success: function(data){
      if(data == ""){
        $('#userlist').append('<tr><td colspan="6"><center>No se encontraron datos</center></td></tr>' );
      }else{
        $('#userlist').html(''); 
            $.each(data, function(i, item) {
            content = '<tr><td>' + item.id + '</td><td>' + item.nombre + '</td><td>' + item.apellido + '</td><td>' + item.email + '</td>';
            if(item.imgperfil){
            content += '<td>' +item.imgperfil + '</td>';
            }else{
              content += '<td></td>';
            }
            var url = '{{ url('user') }}' + '/' + item.id;
          
            content += '<td><a href="' + url + '" style="margin-right:5px;" class="btn btn-secondary"> <i class="fas fa-edit"></i></a>';
            content += '<button onclick="deleteUser('+item.id+')" style="margin-right:5px;" class="btn btn-danger"> <i class="fas fa-trash"></i></button></td>';
            content += '</tr>';
            $('#userlist').append(content);
        });
      }
        },error:function(){ 
            $('#userlist').append('<tr><td colspan="6"><center>No se encontraron datos</center></td></tr>' );
        }    
        
            });

        
          function deleteUser(id){
           
            $.ajax({
                type:'DELETE',
                url: '/api/users/'+id,
                data: {id:id},
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                $('#validation-errors').html('');
                $('#validation-errors').append('<div class="alert alert-success">'+data+'</div');
                location.reload();
                },
                error: function (xhr) {
                 
                 $('#validation-errors').html('');
                 $.each(xhr.responseJSON, function(key,value) {
                     $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                 }); 
                 },
           });
}
 
 
      
</script>
      
</html>