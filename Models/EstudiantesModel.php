<?php
class EstudiantesModel extends Mysql{
    public function __construct()
    {
        parent::__construct();
    }
    public function selectEstudiante()
    {
        $sql = "SELECT * FROM estudiante";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarEstudiante(String $codigo, String $dni, String $nombre, String $carrera, String $direccion, String $telefono)
    {
        $this->codigo = $codigo;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->carrera = $carrera;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $query = "INSERT INTO estudiante(codigo,dni,nombre,carrera,direccion,telefono) VALUES (?,?,?,?,?,?)";
        $data = array($this->codigo, $this->dni, $this->nombre, $this->carrera, $this->direccion, $this->telefono);
        $this->insert($query, $data);
        return true;
    }
    public function editEstudiante(int $id)
    {
        $sql = "SELECT * FROM estudiante WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarEstudiante(String $codigo, String $dni, String $nombre, String $carrera, String $direccion, String $telefono, int $id)
    {
        $this->codigo = $codigo;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->carrera = $carrera;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->id = $id;
        $query = "UPDATE estudiante SET codigo = ?, dni = ?, nombre = ?, carrera = ?, direccion = ?, telefono = ?  WHERE id = ?";
        $data = array($this->codigo, $this->dni, $this->nombre, $this->carrera, $this->direccion, $this->telefono, $this->id);
        $this->update($query, $data);
        return true;
    }
    public function estadoEstudiante(int $estado, int $id)
    {
        $this->estado = $estado;
        $this->id = $id;
        $query = "UPDATE estudiante SET estado = ? WHERE id = ?";
        $data = array($this->estado, $this->id);
        $this->update($query, $data);
        return true;
    }
}
?>