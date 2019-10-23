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
}