<?php
class EditorialModel extends Mysql{
    public $id, $ruc, $nombre, $telefono, $direccion;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectEditorial()
    {
        $sql = "SELECT * FROM editorial";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarEditorial(String $nombre)
    {
        $this->nombre = $nombre;
        $query = "INSERT INTO editorial(editorial) VALUES (?)";
        $data = array($this->nombre);
        $this->insert($query, $data);
        return true;
    }
    public function editEditorial(int $id)
    {
        $sql = "SELECT * FROM editorial WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarEditorial(String $nombre, int $id)
    {
        $this->nombre = $nombre;
        $this->id = $id;
        $query = "UPDATE editorial SET editorial = ? WHERE id = ?";
        $data = array($this->nombre, $this->id);
        $this->update($query, $data);
        return true;
    }
    public function estadoEditorial(int $estado, int $id)
    {
        $this->estado = $estado;
        $this->id = $id;
        $query = "UPDATE editorial SET estado = ? WHERE id = ?";
        $data = array($this->estado, $this->id);
        $this->update($query, $data);
        return true;
    }
}
?>