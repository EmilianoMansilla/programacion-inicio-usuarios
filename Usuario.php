<?php
class Usuario {
    public $nombres;
    public $apellidos;
    public $edad;
    public $cedula;
    public $contrasena;
    public $rol;

    public function __construct($nombres, $apellidos, $edad, $cedula, $contrasena, $rol) {
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
        $this->cedula = $cedula;
        $this->contrasena = $contrasena;
        $this->rol = $rol;
    }
}
?>