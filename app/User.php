<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    // Si estás usando la tabla por defecto 'users', no necesitas declarar el nombre de la tabla.
    // protected $table = 'users';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'name',
        'email',
        'id_area',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    // Si no usas timestamps (created_at, updated_at), puedes desactivarlos
    public $timestamps = false;

    // Si quieres que Laravel no intente encriptar la contraseña, puedes quitar el mutator de password.
}
