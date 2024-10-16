<?php

namespace App\Utils;

class Validacoes
{
    private static $token = '123';

    public static  function validarToken($token) {
        return (self::$token == $token);
    }
}
