<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Trae todos los registros de la tabla users
        return response()->json($users); // Retorna los usuarios como JSON (puedes cambiar a una vista si quieres)
    }
}