<?php
namespace App\Exceptions;

class MessageException {
    const DB_CONECTION = "¡Woops! Error de conexión a la base de datos";
    const DB_GETDATA = "No se ha podido recuperar los datos, si el error persiste, por favor contacte con los administradores";
    const DB_SAVEDATA = "¡Woops! No se ha podido registrar los datos, si el error persiste, por favor contacte con los administradores";
    const DB_UPDATEDATA = "¡Woops! No se ha podido editar los datos, si el error persiste, por favor contacte con los administradores";
    const DB_DELETEDATA = "¡Woops! No se ha podido eliminar los datos, si el error persiste, por favor contacte con los administradores";
    const DB_DEPENDENCE = '!No se puede eliminar uno de los registros, esto puede ocacionar problemas en el funcionamiento, si desea eliminarlo por favor contacte con los administradores';
    const DB_NOT_FOUND = 'No existe el registro';
    const DB_FAIL_PASSWORD = "Contraseña incorrecta";
    const DB_NO_USER = "No existe usuario";
    const DB_EXIST = 'Ya esta registrado';
}