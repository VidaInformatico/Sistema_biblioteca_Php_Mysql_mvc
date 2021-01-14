<?php
class Materia extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();
    }
    public function materia()
    {
        $data = $this->model->selectMateria();
        $this->views->getView($this, "listar", $data);
    }
    public function registrar()
    {
        $materia = $_POST['nombre'];
        $insert = $this->model->insertarMateria($materia);
        if ($insert) {
            header("location: " . base_url() . "materia");
            die();    
        }
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editMateria($id);
        if ($data == 0) {
            $this->materia();
        } else {
            $this->views->getView($this, "editar", $data);
        }
    }
    public function modificar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $actualizar = $this->model->actualizarMateria($nombre, $id);
        if ($actualizar) {   
            header("location: " . base_url() . "materia");
            die();
        }
    }
    public function eliminar()
    {
        $id = $_POST['id'];
        $this->model->estadoMateria(0, $id);
        header("location: " . base_url() . "materia");
        die();
    }
    public function reingresar()
    {
        $id = $_POST['id'];
        $this->model->estadoMateria(1, $id);
        header("location: " . base_url() . "materia");
        die();
    }
}
?>