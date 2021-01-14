<?php
    class Configuracion extends Controllers{
        public function __construct()
        {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
            parent::__construct();

        }
        public function listar()
        {
            $data = $this->model->selectConfiguracion();         
            $this->views->getView($this, "Listar", $data, "");
        }
    public function actualizar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $actualizar = $this->model->actualizarConfiguracion($nombre, $telefono, $direccion ,$id);
        if ($actualizar) {
            header("location: " . base_url() . "configuracion/listar");
        }
        die();
    }
}
