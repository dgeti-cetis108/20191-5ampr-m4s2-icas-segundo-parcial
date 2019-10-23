<?php
namespace App\Models;

class Usuario {
    public $id;
    public $nombre;
    public $contrasenia;
    public $nombres;
    public $apellidos;
    public $correo_electronico;
    public $recordatorio;
    public $activo;

    public static function Acceso($nombre_de_usuario, $contrasenia) {
        $sql = sprintf("select id,nombre,nombres,apellidos,correo_electronico from usuarios where (nombre='%s' or correo_electronico='%s') and contrasenia='%s'", $nombre_de_usuario, $nombre_de_usuario, $contrasenia);
        
        $cnn = new Conexion();

        $rst = $cnn->query($sql); // Cascadia Code
        if (!$rst) {
            die("Error al ejecutar la consulta: $sql");
        } else {
            if ($rst->num_rows == 1) {
                $row = $rst->fetch_assoc();
                $usuario = new Usuario();
                $usuario->id = $row['id'];
                $usuario->nombre = $row['nombre'];
                $usuario->nombres = $row['nombres'];
                $usuario->apellidos = $row['apellidos'];
                $usuario->correo_electronico = $row['correo_electronico'];

                return $usuario;
            } else {
                return false;
            }
        }

    }
}