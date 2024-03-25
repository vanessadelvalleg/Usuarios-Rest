<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;


class UsersController extends Controller
{
    public function index()
    {
    
        $users = json_decode(User::all());
        return response()->json($users);
    }

    //crear usuarios
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'nombre' => 'required',
            'apellido' => 'required',
            'password' => 'required'
        ], $messages = [
            'nombre.required' => 'El :attribute del usuario es requerido.',
            'email.required' => 'El :attribute del usuario es requerido.',
            'email.unique' => 'El :attribute del usuario esta repetido.',
            'apellido.required' => 'El :attribute del usuario es requerido.',
            'password.required' => 'El :attribute del usuario es requerido.',
        ]);


        
        if ($validator->fails()) {
            
            return response()->json($validator->errors(), 400);
            
        }else{
            $user = new User($request->all());
            if($request->file('imgperfil')){
                $imageName = time().'.'.$user->imgperfil->extension();
                $user->imgperfil->move(public_path('imgperfil'), $imageName);
        }else{
            if(!empty($request->imgperfil)){
                $imageName = time();
            }else{
                $imageName = '';
            }
            
        } 
            
            $user->imgperfil=$imageName;
            
            $user->save();
            
        return response()->json('El usuario se creo correctamente.', 200);
        }
        }
    

    //modificar usuarios
    public function update(Request $request, $id)
    {
        $usuario = User::find($request->id);
       
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
        ], $messages = [
            'nombre.required' => 'El :attribute del usuario es requerido.',
            'email.required' => 'El :attribute del usuario es requerido.',
            
            'apellido.required' => 'El :attribute del usuario es requerido.',
        ]);
        if ($validator->fails()) {
            
            return response()->json($validator->errors(), 400);
        }else{
            
    if(!empty($request->id)){
    if($usuario){
       
        if(!empty($request->imgperfil)){
            File::delete(public_path('imgperfil/'. $usuario->imgperfil));
        if($request->file('imgperfil')){
                $imageName = time().'.'.$request->imgperfil->extension();
                $request->imgperfil->move(public_path('imgperfil'), $imageName);
        }else{
            $imageName = time();
        } 

           
            $usuario->imgperfil=$imageName;
            
        }
    
        $usuario->fill([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'password' =>$usuario->password,
            'email' => $request->email,
            'imgperfil' =>  $usuario->imgperfil,
        ]);
          $usuario->save();
          
           return response()->json('El usuario se actualizo correctamente.', 200);
    
    }else{
    return response()->json('No existe un usuario con el id proporcionado', 400);
    } 
    }else{
    return response()->json('Es necesario proporcionar el id para poder actualizar al usuario', 400);   
    }
}
    
}

    //eliminar usuarios
    public function delete(User $user)
   {
    $usuario = User::where('id', $user->id)->first();
 
    if($usuario){

        if(public_path('imgperfil/'. $usuario->imgperfil)){
           File::delete(public_path('imgperfil/'. $usuario->imgperfil));
        }
        $usuario->delete();
       return response()->json('El usuario se elimino correctamente', 200);
    }else{
        return response()->json('No existe un usuario con ese id', 400);
    }
   
   }
}
