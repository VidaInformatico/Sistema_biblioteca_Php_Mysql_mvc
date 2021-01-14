<?php
    class Admin extends Controllers{
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
            $libros = $this->model->selectLibros();
            $estudiantes = $this->model->selectEstudiantes();
            $prestamo = $this->model->selectPrestamo();
            $data = ['libros' => $libros, 'estudiantes' => $estudiantes, 'prestamos' => $prestamo];
            $this->views->getView($this, "listar", $data);
        }
        public function registrar()
        {
            $libro = $_POST['libro'];
            $estudiante = $_POST['estudiante'];
            $cantidad = $_POST['cantidad'];
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $fecha_devolucion = $_POST['fecha_devolucion'];
            $observacion = $_POST['observacion'];
            $cantidadActual = $this->model->selectLibrosCantidad($libro);
            if ($cantidadActual['cantidad'] < $cantidad) {
                header("location: " . base_url() . "admin/listar?no_s");
            }else{
                $insert = $this->model->insertarPrestamo($estudiante, $libro, $fecha_prestamo, $fecha_devolucion, $cantidad, $observacion);
                $total = ($cantidadActual['cantidad'] - $cantidad);
                $this->model->actualizarCantidad($total, $libro);
                if ($insert) {
                    header("location: " . base_url() . "admin/listar");
                    die();
                }
            }
            
        }
        public function devolver()
        {
            $id = $_POST['id'];
            $cantidadprestado = $this->model->selectPrestamoCantidad($id);
            $cantidadActual = $this->model->selectLibrosCantidad($cantidadprestado['id_libro']);
            $total = ($cantidadActual['cantidad'] + $cantidadprestado['cantidad']);
            $prest = $this->model->estadoPrestamo("", 0 , $id);
            $actualizado = $this->model->actualizarCantidad($total, $cantidadprestado['id_libro']);
            if ($actualizado && $prest) {
                header("location: " . base_url() . "admin/listar");
                die();
            }
        }
        public function pdf()
        {
        $datos = $this->model->selectDatos();
        $prestamo = $this->model->selectPrestamoDebe();
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Prestamos");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 5, utf8_decode($datos['nombre']), 0, 1, 'C');

        $pdf->image(base_url() . "/Assets/img/logo.jpg", 180, 10, 30, 30, 'JPG');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, $datos['telefono'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['direccion']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, "Correo: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['correo']), 0, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, "Detalle de Prestamos", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode('Estudiantes'), 1, 0, 'L');
        $pdf->Cell(87, 5, 'Libros', 1, 0, 'L');
        $pdf->Cell(30, 5, 'Fecha Prestamo', 1, 0, 'L');
        $pdf->Cell(15, 5, 'Cant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($prestamo as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(50, 5, $row['nombre'], 1, 0, 'L');
            $pdf->Cell(87, 5, utf8_decode($row['titulo']), 1, 0, 'L');
            $pdf->Cell(30, 5, $row['fecha_prestamo'], 1, 0, 'L');
            $pdf->Cell(15, 5, $row['cantidad'], 1, 1, 'L');
            $contador++;
        }
        $pdf->Output("prestamos.pdf", "I");
        }
    
    }
