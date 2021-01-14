<?php
class Editorial extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();
    }
    public function editorial()
    {
        $data = $this->model->selectEditorial();
        $this->views->getView($this, "listar", $data);
    }
    public function registrar()
    {
        $editorial = $_POST['nombre'];
        $insert = $this->model->insertarEditorial($editorial);
        if ($insert) {
            header("location: " . base_url() . "editorial");
            die();    
        }
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editEditorial($id);
        if ($data == 0) {
            $this->editorial();
        } else {
            $this->views->getView($this, "editar", $data);
        }
    }
    public function modificar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $actualizar = $this->model->actualizarEditorial($nombre, $id);
        if ($actualizar) {   
            header("location: " . base_url() . "editorial");
            die();
        }
    }
    public function eliminar()
    {
        $id = $_POST['id'];
        $this->model->estadoEditorial(0, $id);
        header("location: " . base_url() . "editorial");
        die();
    }
    public function reingresar()
    {
        $id = $_POST['id'];
        $this->model->estadoEditorial(1, $id);
        header("location: " . base_url() . "editorial");
        die();
    }
}
?>