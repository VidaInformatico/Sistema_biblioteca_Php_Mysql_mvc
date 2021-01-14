<?php
    class Autor extends Controllers{
        public function __construct()
        {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
            parent::__construct();

        }
        public function autor()
        {
            $data = $this->model->selectAutor();         
            $this->views->getView($this, "listar", $data);
        }
        public function registrar()
        {
            $autor = $_POST['nombre'];
            $img = $_FILES['imagen'];
            $nombre = $img['name'];
            $nombreTemp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $nombre;
            $destino = "Assets/images/autor/".$fecha;
            if ($nombre == null || $nombre == "") {
                $insert = $this->model->insertarAutor($autor, "default-avatar.png");
            } else {
                $insert = $this->model->insertarAutor($autor, $fecha);
                if ($insert) {
                    move_uploaded_file($nombreTemp, $destino);
                }
            }
            header("location: " . base_url() . "autor");
            die();
        }
        public function editar()
        {
            $id = $_GET['id'];
            $data = $this->model->editAutor($id);
            if ($data == 0) {
                $this->autor();
            }else{
                $this->views->getView($this, "editar", $data);
            }
        }
        public function modificar()
        {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $imgTmp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $imgName;
            $destino = "Assets/images/autor/".$fecha;
            $imgAntigua = $_POST['foto'];
            
            if ($imgName == null || $imgName == "")  {
                $actualizar = $this->model->actualizarAutor($nombre, $imgAntigua, $id);
            }else{
                $actualizar = $this->model->actualizarAutor($nombre, $fecha, $id);
                if ($actualizar) {
                    move_uploaded_file($imgTmp, $destino);
                    if ($imgAntigua != "default-avatar.png") {
                        unlink("Assets/images/autor/" . $imgAntigua);
                    }
                }
            }
            header("location: " . base_url() . "autor");
            die();
        }
        public function eliminar()
        {
            $id = $_POST['id'];
            $this->model->estadoAutor(0, $id);
            header("location: " . base_url() . "autor");
            die();
        }
        public function reingresar()
        {
            $id = $_POST['id'];
            $this->model->estadoAutor(1, $id);
            header("location: " . base_url() . "autor");
            die();
        }
}
