<?php
class Estudiantes extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();
    }
    public function estudiantes()
    {
        $data = $this->model->selectEstudiante();
        $this->views->getView($this, "listar", $data);
    }
    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $carrera = $_POST['carrera'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $insert = $this->model->insertarEstudiante($codigo, $dni, $nombre, $carrera, $direccion, $telefono);
        if ($insert) {
            header("location: " . base_url() . "estudiantes");
            die();    
        }
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editEstudiante($id);
        if ($data == 0) {
            $this->estudiantes();
        } else {
            $this->views->getView($this, "editar", $data);
        }
    }
    public function modificar()
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $carrera = $_POST['carrera'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $actualizar = $this->model->actualizarEstudiante($codigo, $dni, $nombre, $carrera, $direccion, $telefono, $id);
        if ($actualizar) {   
            header("location: " . base_url() . "estudiantes"); 
            die();
        }
    }
    public function eliminar()
    {
        $id = $_POST['id'];
        $this->model->estadoEstudiante(0, $id);
        header("location: " . base_url() . "estudiantes");
        die();
    }
    public function reingresar()
    {
        $id = $_POST['id'];
        $this->model->estadoEstudiante(1, $id);
        header("location: " . base_url() . "estudiantes");
        die();
    }
}
?>