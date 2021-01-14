<?php
class Usuarios extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url());
        }
        parent::__construct();
    }
    public function listar()
    {
        $data = $this->model->selectUsuarios();
        $this->views->getView($this, "listar", $data);
    }
    public function insertar()
    {
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $rol = $_POST['rol'];
        $hash = hash("SHA256", $clave);
        $this->model->insertarUsuarios($nombre, $usuario, $hash, $rol);
        header("location: " . base_url() . "usuarios/listar");
        die();
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editarUsuarios($id);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Editar", $data);
        }
    }
    public function actualizar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $rol = $_POST['rol'];
        $actualizar = $this->model->actualizarUsuarios($nombre, $usuario, $rol, $id);
        if ($actualizar == 1) {
            $alert = 'modificado';
        } else {
            $alert =  'error';
        }
        header("location: " . base_url() . "usuarios/listar");
        die();
    }
    public function eliminar()
    {
        $id = $_POST['id'];
        $this->model->eliminarUsuarios($id);
        header("location: " . base_url() . "usuarios/listar");
        die();
    }
    public function reingresar()
    {
        $id = $_POST['id'];
        $this->model->reingresarUsuarios($id);
        $this->model->selectUsuarios();
        header('location: ' . base_url() . 'Usuarios/Listar');
        die();
    }
    public function login()
    {
        if (!empty($_POST['usuario']) || !empty($_POST['clave'])) {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->selectUsuario($usuario, $hash);
            if (!empty($data)) {
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['usuario'] = $data['usuario'];
                    $_SESSION['correo'] = $data['correo'];
                    $_SESSION['rol'] = $data['rol'];
                    $_SESSION['activo'] = true;
                    header('location: '.base_url(). 'admin/listar');
            } else {
                $error = 0;
                header("location: ".base_url()."?msg=$error");
            }
        }
    }
    public function cambiar()
    {
        $id = $_SESSION['id'];
        $actual = $_POST['actual'];
        $hash = hash("SHA256", $actual);
        $nueva = hash("SHA256", $_POST['nueva']);
        $data = $this->model->cambiarPass($hash, $id);
        if ($data != null || $data != "") {
            $cambio = $this->model->cambiarContra($nueva, $id);
            if ($cambio == 1) {
                header("Location: " . base_url(). "usuarios/salir");
            }
        }else{
            header("Location: " . base_url() . "usuarios/listar?error");
        }  
    }
    public function perfil()
    {

        $data = $this->model->selectUsuariosPass(1);
        $this->views->getView($this, "cambiarPass", $data);
    }
    public function salir()
    {
        session_destroy();
        header("Location: ".base_url());
    }
}
