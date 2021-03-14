<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MessageException;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    try {
      $usuario = User::where('email', $request->email)->first();
      if ($usuario) {
        if (Hash::check($request->password, $usuario->password)) { //verifica si la contrasena es correcta o no
          return response(['data' => $usuario, 'message' => "Se logeo correctamente",]);
        } else {
          return response(['message' => MessageException::DB_FAIL_PASSWORD], Response::HTTP_BAD_REQUEST);
        }
      } else {
        return response(['message' => MessageException::DB_NO_USER], Response::HTTP_BAD_REQUEST);
      }
    } catch (\Throwable $th) {
      return response(["message" => MessageException::DB_GETDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
