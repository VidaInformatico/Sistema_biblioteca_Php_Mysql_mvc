<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-center">Libros</h5>
                    <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevoLibro">Nuevo</button>
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Titulo</th>
                                    <th>Cant</th>
                                    <th>Autor</th>
                                    <th>Editorial</th>
                                    <th>Materia</th>
                                    <th>Foto</th>
                                    <th>Estado</th>
                                    <th>Descripción</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['libros'] as $libro) {
                                    if ($libro['estado'] == 1) {
                                        $estado = '<span class="badge-success p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $libro['titulo']; ?></td>
                                        <td><?php echo $libro['cantidad']; ?></td>
                                        <td><?php echo $libro['autor']; ?></td>
                                        <td><?php echo $libro['editorial']; ?></td>
                                        <td><?php echo $libro['materia']; ?></td>
                                        <td><img src="<?php echo base_url() ?>Assets/images/libros/<?php echo $libro['imagen']; ?>" width="150" class="img-thumbnail"></td>
                                        <td><?php echo $estado ?></td>
                                        <td><?php echo $libro['descripcion']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>libros/editar?id=<?php echo $libro['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <?php if ($libro['estado'] == 1) { ?>
                                                <form method="post" action="<?php echo base_url(); ?>libros/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" action="<?php echo base_url(); ?>libros/reingresar" class="d-inline reingresar">
                                                    <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">
                                                    <button class="btn btn-success" type="submit"><i class="fas fa-audio-description"></i></button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="nuevoLibro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Registro Libro</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url() ?>libros/registrar" method="post" id="frmLibros" class="row" autocomplete="off" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input id="titulo" class="form-control" type="text" name="titulo" placeholder="Título del libro">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="autor">Autor</label>
                                <select id="autor" class="form-control" name="autor">
                                    <?php foreach ($data['autores'] as $autor) { ?>
                                        <option value="<?php echo $autor['id']; ?>"><?php echo $autor['autor']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editorial">Editorial</label>
                                <select id="editorial" class="form-control" name="editorial">
                                    <?php foreach ($data['editoriales'] as $editorial) { ?>
                                        <option value="<?php echo $editorial['id']; ?>"><?php echo $editorial['editorial']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="materia">Materia</label>
                                <select id="materia" class="form-control" name="materia">
                                    <?php foreach ($data['materias'] as $materia) { ?>
                                        <option value="<?php echo $materia['id']; ?>"><?php echo $materia['materia']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="text" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="num_pagina">Cantidad de página</label>
                                <input id="num_pagina" class="form-control" type="number" name="num_pagina" placeholder="Cantidad Página">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="anio_edicion">Año Edición</label>
                                <input id="anio_edicion" class="form-control" type="date" name="anio_edicion" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" class="form-control" name="descripcion" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="imagen">Foto</label>
                                <input id="imagen" class="form-control" type="file" name="imagen">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Registrar</button>
                                <button class="btn btn-danger" data-dismiss="modal" type="button">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php pie() ?>