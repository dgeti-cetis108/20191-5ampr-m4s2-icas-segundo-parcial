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

    public static function BuscarPorNombre($nombre) {
        $sql = sprintf("select nombre from usuarios where nombre='%s'", $nombre);
        $cnn = new Conexion();
        $rst = $cnn->query($sql);
        if (!$rst) {
            die("Error .... $sql");
        }
        if ($rst->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function BuscarPorCorreo($correo) {
        $sql = sprintf("select nombre from usuarios where correo_electronico='%s'", $correo);
        $cnn = new Conexion();
        $rst = $cnn->query($sql);
        if (!$rst) {
            die("Error .... $sql");
        }
        if ($rst->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function GuardarNuevo() {
        if (Usuario::BuscarPorNombre($this->nombre) ||
            Usuario::BuscarPorCorreo($this->correo_electronico)) {
            return false;
        }

        // Aqui va el codigo que ya tenian
    }
}

// Ejemplo de prueba
// $usuario = new Usuario();
// $usuario->nombre = 'bidkar';
// $usuario->contrasenia = '123';
// $usuario->correo_electronico = 'mi@correo.com';
// $usuario->GuardarNuevo();
