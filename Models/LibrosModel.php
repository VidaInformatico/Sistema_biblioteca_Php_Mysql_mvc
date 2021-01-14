<?php
class LibrosModel extends Mysql{
    protected $id, $nombre,$imagen;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectLibro()
    {
        $sql = "SELECT a.id, a.autor, e.id, e.editorial, m.id, m.materia, l.id, l.titulo, l.cantidad, l.id_autor, l.id_editorial, l.id_materia, l.descripcion, l.imagen, l.estado FROM autor a INNER JOIN editorial e INNER JOIN materia m INNER JOIN libro l ON a.id = l.id_autor AND e.id = l.id_editorial WHERE m.id = l.id_materia";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectMateria()
    {
        $sql = "SELECT * FROM materia";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectEditorial()
    {
        $sql = "SELECT * FROM editorial";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectAutor()
    {
        $sql = "SELECT * FROM autor";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarLibro(String $titulo, int $cantidad, int $autor, int $editorial, String $anio_edicion, int $materia, int $num_pagina, String $descripcion, String $imgName)
    {
        $this->titulo = $titulo;
        $this->cantidad = $cantidad;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->anio_edicion = $anio_edicion;
        $this->materia = $materia;
        $this->num_pagina = $num_pagina;
        $this->descripcion = $descripcion;
        $this->imgName = $imgName;
        $query = "INSERT INTO libro (titulo, cantidad, id_autor, id_editorial, anio_edicion, id_materia, num_pagina, descripcion, imagen) VALUES (?,?,?,?,?,?,?,?,?)";
        $data = array($this->titulo, $this->cantidad, $this->autor, $this->editorial,$this->anio_edicion, $this->materia, $this->num_pagina, $this->descripcion, $this->imgName);
        $this->insert($query, $data);
        return true;
    }
    public function editLibro(int $id)
    {
        $sql = "SELECT * FROM libro WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarLibro(String $titulo, int $cantidad, int $autor, int $editorial, String $anio_edicion, int $materia, int $num_pagina, String $descripcion, String $imgName, int $id)
    {
        $this->titulo = $titulo;
        $this->cantidad = $cantidad;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->anio_edicion = $anio_edicion;
        $this->materia = $materia;
        $this->num_pagina = $num_pagina;
        $this->descripcion = $descripcion;
        $this->imgName = $imgName;
        $this->id = $id;
        $query = "UPDATE libro SET titulo=?, cantidad=?, id_autor=?, id_editorial=?, anio_edicion=?, id_materia=?, num_pagina=?, descripcion=?, imagen=? WHERE id = ?";
        $data = array($this->titulo, $this->cantidad, $this->autor, $this->editorial,$this->anio_edicion, $this->materia, $this->num_pagina, $this->descripcion, $this->imgName, $this->id);
        $this->update($query, $data);
        return true;
    }
    public function estadoLibro(int $estado, int $id)
    {
        $this->estado = $estado;
        $this->id = $id;
        $query = "UPDATE libro SET estado = ? WHERE id = ?";
        $data = array($this->estado, $this->id);
        $this->update($query, $data);
        return true;
    }
    
}
