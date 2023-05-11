<?php

namespace App\helpers;

class updateContainersMessages {
    private static $messages = [
        "start" => "El contenedor inició correctamente.",
        "stop" => "El contenedor se detuvo correctamente.",
        "remove" => "El contenedor se eliminó correctamente.",
        "error" => "Hubo un error al querer actualizar el estado del contenedor."
    ];
    public static function getMessage(string $action): string {
        return self::$messages[$action];
    }
}