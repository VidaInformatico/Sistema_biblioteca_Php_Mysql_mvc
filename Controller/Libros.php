<?php
    class Libros extends Controllers{
        public function __construct()
        {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
            parent::__construct();

        }
        public function libros()
        {
            $libro = $this->model->selectLibro();
            $materias = $this->model->selectMateria();
            $editorial = $this->model->selectEditorial();
            $autor = $this->model->selectAutor();
            $data = ['libros' => $libro, 'materias' => $materias, 'editoriales' => $editorial, 'autores' => $autor];
            $this->views->getView($this, "listar", $data);
        }
        public function registrar()
        {
            $titulo = $_POST['titulo'];
            $cantidad = $_POST['cantidad'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $anio_edicion = $_POST['anio_edicion'];
            $editorial = $_POST['editorial'];
            $materia = $_POST['materia'];
            $num_pagina = $_POST['num_pagina'];
            $descripcion = $_POST['descripcion'];
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $nombreTemp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) ."_". $imgName;
            $destino = "Assets/images/libros/" . $fecha;
            if ($imgName == null || $imgName == "") {
                $insert = $this->model->insertarLibro($titulo, $cantidad, $autor, $editorial, $anio_edicion, $materia, $num_pagina, $descripcion, "default-avatar.png");
            }else{
                $insert = $this->model->insertarLibro($titulo, $cantidad, $autor ,$editorial, $anio_edicion, $materia, $num_pagina, $descripcion, $fecha);
                if ($insert) {
                    move_uploaded_file($nombreTemp, $destino);
                }
            }
            header("location: " . base_url() . "libros");
            die();
        }
        public function editar()
        {
            $id = $_GET['id'];
            $materias = $this->model->selectMateria();
            $editorial = $this->model->selectEditorial();
            $autor = $this->model->selectAutor();
            $libro = $this->model->editLibro($id);
            $data = ['materias' => $materias, 'editoriales' => $editorial, 'autores' => $autor, 'libro' => $libro];
            if ($data == 0) {
                $this->libros();
            } else {
                $this->views->getView($this, "editar", $data);
            }
        }
        public function modificar()
        {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $cantidad = $_POST['cantidad'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $anio_edicion = $_POST['anio_edicion'];
            $editorial = $_POST['editorial'];
            $materia = $_POST['materia'];
            $num_pagina = $_POST['num_pagina'];
            $descripcion = $_POST['descripcion'];
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $nombreTemp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $imgName;
            $destino = "Assets/images/libros/".$fecha;
            $imgAntigua = $_POST['foto'];
            if ($imgName == null || $imgName == "") {
                $actualizar = $this->model->actualizarLibro($titulo, $cantidad, $autor ,$editorial, $anio_edicion, $materia, $num_pagina, $descripcion, $imgAntigua, $id);
            } else {
                $actualizar = $this->model->actualizarLibro($titulo, $cantidad, $autor ,$editorial, $anio_edicion, $materia, $num_pagina, $descripcion, $fecha, $id);
                if ($actualizar) {
                    move_uploaded_file($nombreTemp, $destino);
                    if ($imgAntigua != "default-avatar.png") {
                        unlink("Assets/images/libros/" . $imgAntigua);
                    }
                }
            }
            header("location: " . base_url() . "libros");
            die();
        }
        public function eliminar()
        {
            $id = $_POST['id'];
            $this->model->estadoLibro(0, $id);
            header("location: " . base_url() . "libros");
            die();
        }
        public function reingresar()
        {
            $id = $_POST['id'];
            $this->model->estadoLibro(1, $id);
            header("location: " . base_url() . "libros");
            die();
        }
        public function pdf()
        {
            $libros = $this->model->selectLibro();
            require_once 'Libraries/pdf/fpdf.php';
            $pdf = new FPDF('P', 'mm', 'letter');
            $pdf->AddPage();
            $pdf->SetMargins(10, 10, 10);
            $pdf->SetTitle("libros");
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(0, 0, 0);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(196, 5, "Libros", 1, 1, 'C', 1);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(11, 5, utf8_decode('N°'), 1, 0, 'L');
            $pdf->Cell(100, 5, utf8_decode('Titulo'), 1, 0, 'L');
            $pdf->Cell(70, 5, utf8_decode('Autor'), 1, 0, 'L');
            $pdf->Cell(15, 5, 'Cant.', 1, 1, 'L');
            $pdf->SetFont('Arial', '', 10);
            $contador = 1;
            foreach ($libros as $row) {
                $pdf->Cell(11, 5, $contador, 1, 0, 'L');
                $pdf->Cell(100, 5, utf8_decode($row['titulo']), 1, 0, 'L');
                $pdf->Cell(70, 5, utf8_decode($row['autor']), 1, 0, 'L');
                $pdf->Cell(15, 5, $row['cantidad'], 1, 1, 'L');
                $contador++;
            }
            $pdf->Output("libros.pdf", "I");
        }
}
