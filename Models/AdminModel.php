<?php
class AdminModel extends Mysql{
    public function __construct()
    {
        parent::__construct();
    }
    public function selectLibros()
    {
        $sql = "SELECT * FROM libro WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectLibrosCantidad(int $id)
    {
        $sql = "SELECT * FROM libro WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function selectEstudiantes()
    {
        $sql = "SELECT * FROM estudiante WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectPrestamoCantidad()
    {
        $sql = "SELECT * FROM prestamo WHERE estado = 1";
        $res = $this->select($sql);
        return $res;
    }
    public function selectPrestamo()
    {
        $sql = "SELECT e.id, e.nombre, l.id, l.titulo, p.id, p.id_estudiante, p.id_libro, p.fecha_prestamo, p.fecha_devolucion, p.cantidad, p.observacion, p.estado FROM estudiante e INNER JOIN libro l INNER JOIN prestamo p ON p.id_estudiante = e.id WHERE p.id_libro = l.id";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarPrestamo(int $estudiante, int $libro,  String $fecha_prestamo, String $fecha_devolucion,int $cantidad, String $observacion)
    {
        $this->libro = $libro;
        $this->estudiante = $estudiante;
        $this->cantidad = $cantidad;
        $this->fecha_prestamo = $fecha_prestamo;
        $this->fecha_devolucion = $fecha_devolucion;
        $this->observacion = $observacion;
        $query = "INSERT INTO prestamo(id_estudiante, id_libro, fecha_prestamo, fecha_devolucion, cantidad ,observacion) VALUES (?,?,?,?,?,?)";
        $data = array($this->estudiante, $this->libro, $this->fecha_prestamo, $this->fecha_devolucion, $this->cantidad, $this->observacion);
        $this->insert($query, $data);
        return true;
    }
    public function estadoPrestamo(String $obser, int $estado, int $id)
    {
        $this->obser = $obser;
        $this->estado = $estado;
        $this->id = $id;
        $query = "UPDATE prestamo SET observacion = ?, estado = ? WHERE id = ?";
        $data = array($this->obser, $this->estado, $this->id);
        $this->update($query, $data);
        return true;
    }
    public function actualizarCantidad(String $cantidad, int $id)
    {
        $this->cantidad = $cantidad;
        $this->id = $id;
        $query = "UPDATE libro SET cantidad = ? WHERE id = ?";
        $data = array($this->cantidad, $this->id);
        $this->update($query, $data);
        return true;
    }
    public function selectDatos()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function selectPrestamoDebe()
    {
        $sql = "SELECT e.id, e.nombre, l.id, l.titulo, p.id, p.id_estudiante, p.id_libro, p.fecha_prestamo, p.fecha_devolucion, p.cantidad, p.observacion, p.estado FROM estudiante e INNER JOIN libro l INNER JOIN prestamo p ON p.id_estudiante = e.id WHERE p.id_libro = l.id AND p.estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
}
