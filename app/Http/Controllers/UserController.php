<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{


    public function update(User $user)
    {
     return view('usuarios/update', ['user' => $user]);
    }


}
