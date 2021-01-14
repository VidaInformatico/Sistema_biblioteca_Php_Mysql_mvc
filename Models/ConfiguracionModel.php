<?php
class ConfiguracionModel extends Mysql{
    protected $id, $nombre, $telefono, $direccion;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectConfiguracion()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarConfiguracion(string $nombre, string $telefono, string $direccion ,int $id)
    {
        $return = "";
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id = $id;
        $query = "UPDATE configuracion SET nombre=?, telefono=?, direccion=? WHERE id=?";
        $data = array($this->nombre, $this->telefono, $this->direccion ,$this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
?>