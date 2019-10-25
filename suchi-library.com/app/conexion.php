<?php
namespace App;

class Conexion extends \mysqli {
    private $servidor;
    private $usuario;
    private $contrasenia;
    private $base_de_datos;
    private $puerto;

    public function __construct()
    {
        $this->servidor = '127.0.0.1';
        $this->usuario = 'suchiadmin';
        $this->contrasenia = '123';
        $this->base_de_datos = 'suchidb';
        $this->puerto = 3306;
        parent::__construct($this->servidor, $this->usuario, $this->contrasenia, $this->base_de_datos, $this->puerto);
    }
}