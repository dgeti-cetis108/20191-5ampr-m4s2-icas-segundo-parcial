<?php
namespace App\Models;
use App\Conexion;

class Autor {
    public $id;
    public $nombre;
    public $correo_electronico;

    public static function ListaDeAutores() {
        $sql = "select * from autores";
        $cnn = new Conexion();
        
        $rst = $cnn->query($sql); // 😎apurenle
        if (!$rst) {
            die("error en la consulta $sql");
        } else {
            if ($rst->num_rows > 0) {
                $rows = $rst->fetch_assoc();
                $autores = [];
                foreach ($rows as $row) {
                    $autor = new Autor();
                    $autor->id = $row['id'];
                    $autor->nombre = $row['nombre'];
                    $autor->correo_electronico = $row['correo_electronico'];
                    array_push($autores, $autor);
                }
                return $autores;
            } else {
                return false;
            }
        }
    }

    public function GuardarNuevo() {
        $sql = sprintf("insert into autores (nombre, correo_electronico) values ('%s', '%s')", $this->nombre, $this->correo_electronico);
        $cnn = new Conexion();
        $rst = $cnn->query($sql);
        if (!$rst) {
            die("Error al ejecutar la consulta: $sql");
        } else {
            $this->id = $cnn->insert_id;
            $cnn->close();
            return true;
        }
    }

    public function GuardarCambios() {
        if (!Autor::Existe($this->id)) {
            return false;
        }
        $sql = sprintf("update autores set nombre='%s', correo_electronico='%s' where id=%d", $this->nombre, $this->correo_electronico, $this->id);
        $cnn = new Conexion();
        $rst = $cnn->query($sql);
        if (!$rst) {
            die("Error al ejecutar la consulta: $sql");
        } else {
            $cnn->close();
            return true;
        }
    }

    public static function Eliminar($id) {
        if (!Autor::Existe($id)) {
            return false;
        }
        $sql = sprintf("delete from autores where id=%d", $id);
        $cnn = new Conexion();
        $rst = $cnn->query($sql);
        if (!$rst) {
            die("Error al ejecutar la consulta: $sql");
        } else {
            $cnn->close();
            return true;
        }
    }

    public static function Existe($id) {
        $sql = sprintf("select nombre from autores where id=%d", $id);
        $cnn = new Conexion();
        $rst = $cnn->query($sql);
        $cnn->close();

        if (!$rst) {
            die("Error al ejectuar la consulta: $sql");
        }

        if ($rst->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}